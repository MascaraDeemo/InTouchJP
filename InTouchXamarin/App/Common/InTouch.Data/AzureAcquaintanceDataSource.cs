﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Threading;
using System.Threading.Tasks;
using InTouch.Abstractions;
using InTouch.Models;
using InTouch.Util;
using Microsoft.Practices.ServiceLocation;
using Microsoft.WindowsAzure.MobileServices;
using Microsoft.WindowsAzure.MobileServices.SQLiteStore;
using Microsoft.WindowsAzure.MobileServices.Sync;
using PCLStorage;

namespace InTouch.Data
{
    public class AzureAcquaintanceSource : IDataSource<Acquaintance>
    {
		public AzureAcquaintanceSource()
		{
			OnDataSyncError += (object sender, DataSyncErrorEventArgs<Acquaintance> e) => {
                
			};
		}

		MobileServiceClient _MobileService { get; set; }

		SyncHandler<Acquaintance> _SyncHandler;

        IMobileServiceSyncTable<Acquaintance> _AcquaintanceTable;

        MobileServiceSQLiteStore _MobileServiceSQLiteStore;

        bool _IsInitialized;

		string _DataPartitionId => GuidUtility.Create(Settings.DataPartitionPhrase).ToString().ToUpper();

        const string _LocalDbName = "InTouch.db";


		public event DataSyncErrorEventHandler<Acquaintance> OnDataSyncError;


		protected virtual void RaiseDataSyncErrorEvent(DataSyncErrorEventArgs<Acquaintance> e)
		{
			DataSyncErrorEventHandler<Acquaintance> handler = OnDataSyncError;

			if (handler != null)
				handler(this, e);
		}

        #region Data Access

        public async Task<IEnumerable<Acquaintance>> GetItems()
        {
            return await Execute<IEnumerable<Acquaintance>>(async () =>
            {
                await SyncItemsAsync().ConfigureAwait(false);
                return await _AcquaintanceTable.Where(x => x.DataPartitionId == _DataPartitionId).OrderBy(x => x.LastName).ToEnumerableAsync().ConfigureAwait(false);
            }, new List<Acquaintance>()).ConfigureAwait(false);
        }

        public async Task<Acquaintance> GetItem(string id)
        {
            return await Execute<Acquaintance>(async () =>
            {
                await SyncItemsAsync().ConfigureAwait(false);
                return await _AcquaintanceTable.LookupAsync(id).ConfigureAwait(false);
            }, null).ConfigureAwait(false);
        }

        public async Task<bool> AddItem(Acquaintance item)
        {
            return await Execute<bool>(async () =>
            {
                item.DataPartitionId = _DataPartitionId;

                await Initialize().ConfigureAwait(false);
                await _AcquaintanceTable.InsertAsync(item).ConfigureAwait(false);
                await SyncItemsAsync().ConfigureAwait(false);
                return true;
            }, false).ConfigureAwait(false);
        }

        public async Task<bool> UpdateItem(Acquaintance item)
        {
            return await Execute<bool>(async () =>
            {
                await Initialize().ConfigureAwait(false);
                await _AcquaintanceTable.UpdateAsync(item).ConfigureAwait(false);
                await SyncItemsAsync().ConfigureAwait(false);
                return true;
            }, false).ConfigureAwait(false);
        }

        public async Task<bool> RemoveItem(Acquaintance item)
        {
            return await Execute<bool>(async () =>
            {
                await Initialize().ConfigureAwait(false);
                await _AcquaintanceTable.DeleteAsync(item).ConfigureAwait(false);
                await SyncItemsAsync().ConfigureAwait(false);
                return true;
            }, false).ConfigureAwait(false);
        }

        #endregion


        #region helper methods for dealing with the state of the local store


        async Task<bool> Initialize()
        {
            return await Execute<bool>(async () =>
            {
                if (_IsInitialized)
                    return true;
				_MobileService = new MobileServiceClient(Settings.AzureAppServiceUrl, GetHttpClientHandler());

                _MobileServiceSQLiteStore = new MobileServiceSQLiteStore(_LocalDbName);

                _MobileServiceSQLiteStore.DefineTable<Acquaintance>();

                _AcquaintanceTable = _MobileService.GetSyncTable<Acquaintance>();

				_SyncHandler = new SyncHandler<Acquaintance>();

				_SyncHandler.OnDataSyncError += (object sender, DataSyncErrorEventArgs<Acquaintance> e) => {
					RaiseDataSyncErrorEvent(e);
				};

				await _MobileService.SyncContext.InitializeAsync(_MobileServiceSQLiteStore, _SyncHandler).ConfigureAwait(false);

                _IsInitialized = true;

                return _IsInitialized;
            }, false).ConfigureAwait(false);
        }


        async Task<bool> SyncItemsAsync()
        {
            return await Execute(async () =>
            {
                if (Settings.LocalDataResetIsRequested)
                    await ResetLocalStoreAsync().ConfigureAwait(false);

                await Initialize().ConfigureAwait(false);
                await EnsureDataIsSeededAsync().ConfigureAwait(false);
                await _AcquaintanceTable.PullAsync($"getAll{typeof(Acquaintance).Name}", _AcquaintanceTable.Where(x => x.DataPartitionId == _DataPartitionId)).ConfigureAwait(false);
                return true;
            }, false);
        }


        async Task EnsureDataIsSeededAsync()
        {
            if (Settings.DataIsSeeded)
                return;

            await _AcquaintanceTable.PullAsync($"getAll{typeof(Acquaintance).Name}", _AcquaintanceTable.Where(x => x.DataPartitionId == _DataPartitionId)).ConfigureAwait(false);

            var any = (await _AcquaintanceTable.Where(x => x.DataPartitionId == _DataPartitionId).OrderBy(x => x.LastName).ToEnumerableAsync().ConfigureAwait(false)).Any();

            if (any)
                Settings.DataIsSeeded = true;


            if (!Settings.DataIsSeeded)
            {
                var newItems = SeedData.Get(_DataPartitionId);

                foreach (var i in newItems)
                {
                    await _AcquaintanceTable.InsertAsync(i);
                }

                Settings.DataIsSeeded = true;
            }
        }


        async Task ResetLocalStoreAsync()
        {
            _AcquaintanceTable = null;


            _MobileServiceSQLiteStore?.Dispose();
            _MobileServiceSQLiteStore = null;


            await DeleteOldLocalDatabase().ConfigureAwait(false);
            _IsInitialized = false;
            Settings.LocalDataResetIsRequested = false;
            Settings.DataIsSeeded = false;
        }


        async Task DeleteOldLocalDatabase()
        {
			var datastoreFolderPathProvider = ServiceLocator.Current.GetInstance<IDatastoreFolderPathProvider>();
			var databaseFolderPath = datastoreFolderPathProvider.GetPath();
			var databaseFolder = await FileSystem.Current.GetFolderFromPathAsync(databaseFolderPath).ConfigureAwait(false);
            var dbFile = await databaseFolder.GetFileAsync(_LocalDbName, CancellationToken.None).ConfigureAwait(false);

            if (dbFile != null)
                await dbFile.DeleteAsync().ConfigureAwait(true);
        }

        #endregion


        #region some nifty exception helpers


        static async Task Execute(Func<Task> execute)
        {
            try
            {
                await execute().ConfigureAwait(false);
            }
            catch (Exception ex)
            {
                HandleExceptions(ex);
            }
        }


        static async Task<T> Execute<T>(Func<Task<T>> execute, T defaultReturnObject)
        {
            try
            {
                return await execute().ConfigureAwait(false);
            }
            catch (Exception ex)
            {
                HandleExceptions(ex);
            }
            return defaultReturnObject;
        }


        static void HandleExceptions(Exception ex)
        {
            if (ex is MobileServiceInvalidOperationException)
            {
                // TODO: report with HockeyApp
                System.Diagnostics.Debug.WriteLine($"MOBILE SERVICE ERROR {ex.Message}");
                return;
            }

            if (ex is MobileServicePushFailedException)
            {
                var pushResult = ((MobileServicePushFailedException)ex).PushResult;

                foreach (var e in pushResult.Errors)
                {
                    System.Diagnostics.Debug.WriteLine($"ERROR {pushResult.Status}: {e.RawResult}");
                }
            }

            else
            {
                // TODO: report with HockeyApp
                System.Diagnostics.Debug.WriteLine($"ERROR {ex.Message}");
            }
        }

        #endregion



        HttpClientHandler GetHttpClientHandler()
        {
            return ServiceLocator.Current.GetInstance<IHttpClientHandlerFactory>().GetHttpClientHandler();
        }
    }
}

