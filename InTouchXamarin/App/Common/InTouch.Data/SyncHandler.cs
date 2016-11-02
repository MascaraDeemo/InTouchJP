using System.Threading.Tasks;
using InTouch.Abstractions;
using InTouch.Models;
using Microsoft.WindowsAzure.MobileServices;
using Microsoft.WindowsAzure.MobileServices.Sync;
using Newtonsoft.Json.Linq;

namespace InTouch.Data
{
	public class SyncHandler<T> : IMobileServiceSyncHandler where T : IObservableEntityData
	{
		public async Task<JObject> ExecuteTableOperationAsync(IMobileServiceTableOperation operation)
		{
			MobileServicePreconditionFailedException preconditionFailedException = null;
			JObject result = null;

			do
			{
				preconditionFailedException = null;
				try
				{
					result = await operation.ExecuteAsync();
				}
				catch (MobileServicePreconditionFailedException ex)
				{
					preconditionFailedException = ex;
				}

				if (preconditionFailedException != null)
				{
					var serverItem = preconditionFailedException.Value.ToObject<T>();

					operation.Item[MobileServiceSystemColumns.Version] = serverItem.Version;

				}
			} 
			while (preconditionFailedException != null);

			return result;
		}

		public Task OnPushCompleteAsync(MobileServicePushCompletionResult result)
		{
			return Task.FromResult(0);
		}

		public event DataSyncErrorEventHandler<Acquaintance> OnDataSyncError;


		protected virtual void RaiseDataSyncErrorEvent(DataSyncErrorEventArgs<Acquaintance> e)
		{
			DataSyncErrorEventHandler<Acquaintance> handler = OnDataSyncError;

			if (handler != null)
				handler(this, e);
		}
	}
}

