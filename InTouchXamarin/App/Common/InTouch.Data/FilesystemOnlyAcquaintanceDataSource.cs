using System;
using System.Collections.Generic;
using PCLStorage;
using System.Linq;
using System.Threading.Tasks;
using Newtonsoft.Json;
using InTouch.Abstractions;
using InTouch.Models;

namespace InTouch.Data
{

	public class FilesystemOnlyAcquaintanceDataSource : IDataSource<Acquaintance>
	{
		const string _FileName = "acquaintances.json";

		readonly IFolder _RootFolder;

		bool _IsInitialized;

		List<Acquaintance> _Acquaintances;

		public FilesystemOnlyAcquaintanceDataSource()
		{
			_RootFolder = FileSystem.Current.LocalStorage;

			OnDataSyncError += (object sender, DataSyncErrorEventArgs<Acquaintance> e) => {
				
			};
		}

		#region IDataSource implementation

		public event DataSyncErrorEventHandler<Acquaintance> OnDataSyncError;

		public async Task<IEnumerable<Acquaintance>> GetItems()
		{
			await EnsureInitialized().ConfigureAwait(false);

			return await Task.FromResult(_Acquaintances.OrderBy(x => x.LastName)).ConfigureAwait(false);
		}

		public async Task<Acquaintance> GetItem(string id)
		{
			await EnsureInitialized().ConfigureAwait(false);

			return await Task.FromResult(_Acquaintances.SingleOrDefault(x => x.Id == id)).ConfigureAwait(false);
		}

		public async Task<bool> AddItem(Acquaintance item)
		{
			_Acquaintances.Add(item);

			await WriteFile(_RootFolder, _FileName, JsonConvert.SerializeObject(_Acquaintances)).ConfigureAwait(false);

			return true;
		}

		public async Task<bool> UpdateItem(Acquaintance item)
		{
			await EnsureInitialized().ConfigureAwait(false);

			int i = _Acquaintances.FindIndex(a => a.Id == item.Id);

			if (i < 0)
				return false;
			
			_Acquaintances[i] = item;

			await WriteFile(_RootFolder, _FileName, JsonConvert.SerializeObject(_Acquaintances)).ConfigureAwait(false);

			return true;
		}

		public async Task<bool> RemoveItem(Acquaintance item)
		{
			await EnsureInitialized().ConfigureAwait(false);

			_Acquaintances.RemoveAll(c => c.Id == item.Id);

			await WriteFile(_RootFolder, _FileName, JsonConvert.SerializeObject(_Acquaintances)).ConfigureAwait(false);

			return true;
		}

		#endregion

		#region supporting methods

		async Task Initialize()
		{
			if (!await FileExists(_RootFolder, _FileName).ConfigureAwait(false))
			{
				await CreateFile(_RootFolder, _FileName).ConfigureAwait(false);
			}

			if (string.IsNullOrWhiteSpace(await GetFileContents(await GetFile(_RootFolder, _FileName).ConfigureAwait(false)).ConfigureAwait(false)))
			{
				_Acquaintances = GenerateAcquaintances();

				await WriteFile(_RootFolder, _FileName, JsonConvert.SerializeObject(_Acquaintances)).ConfigureAwait(false);
			}
			else
			{
				_Acquaintances = JsonConvert.DeserializeObject<List<Acquaintance>>(await GetFileContents(await GetFile(_RootFolder, _FileName).ConfigureAwait(false)).ConfigureAwait(false));
			}

			_IsInitialized = true;
		}

		async Task EnsureInitialized()
		{
			if (!_IsInitialized)
				await Initialize().ConfigureAwait(false);
		}

		static async Task<bool> FileExists(IFolder folder, string fileName)
		{
			return await Task.FromResult<bool>(await folder.CheckExistsAsync(fileName) == ExistenceCheckResult.FileExists).ConfigureAwait(false);
		}

		static async Task<IFile> CreateFile(IFolder folder, string fileName)
		{
			return await folder.CreateFileAsync(fileName, CreationCollisionOption.OpenIfExists).ConfigureAwait(false);
		}

		static async Task<IFile> GetFile(IFolder folder, string fileName)
		{
			return await folder.GetFileAsync(fileName).ConfigureAwait(false);
		}

		static async Task WriteFile(IFolder folder, string fileName, string fileContents)
		{
			var file = await GetFile(folder, fileName).ConfigureAwait(false);

			await file.WriteAllTextAsync(fileContents).ConfigureAwait(false);
		}

		static async Task<string> GetFileContents(IFile file)
		{
			return await file.ReadAllTextAsync().ConfigureAwait(false);
		}

		static List<Acquaintance> GenerateAcquaintances()
		{
			return new List<Acquaintance>()
			{
				new Acquaintance() { Id = "00004363-F79A-44E7-BC32-6128E2EC8401", FirstName = "Sam", LastName = "Zhou", Company = "QUT", JobTitle = "Student", Email = "q924714879@gmail.com", Phone = "410-733-094", Street = "62 Gager St", City = "Brisbane", PostalCode = "4109", State = "QLD", PhotoUrl = "https://i.imgsafe.org/8cc89b4d23.jpg" },
				new Acquaintance() { Id = "c227bfd2-c6f6-49b5-93ec-afef9eb18d08", FirstName = "Fabian", LastName = "Wentz", Company = "QUT", JobTitle = "Student", Email = "fabian.wentz@connect.qut.edu.au", Phone = "410-353-8029", Street = "51 Main St", City = "Brisbane", PostalCode = "4109", State = "QLD", PhotoUrl = "https://i.imgsafe.org/8cd24ef67a.jpg" },
				new Acquaintance() { Id = "31bf6fe5-18f1-4354-9571-2cdecb0c00af", FirstName = "Lional", LastName = "Tan", Company = "QUT", JobTitle = "Student", Email = "iaape0@gmail.com", Phone = "411-870-7670", Street = "22/40 Lakefield Place", City = "Brisbane", PostalCode = "4113", State = "QLD", PhotoUrl = "https://i.imgsafe.org/8cdbf94c3a.jpg" },
				new Acquaintance() { Id = "45d2ddc0-a8e9-4aea-8b51-2860c708e30d", FirstName = "Simon", LastName = "Liu", Company = "QUT", JobTitle = "Studnet", Email = "527472039", Phone = "412-344-7823", Street = "31 Janice St", City = "Brisbane", PostalCode = "4109", State = "QLD", PhotoUrl = "https://i.imgsafe.org/8cdde71e2d.jpg" },

			};
		}

		#endregion
	} 
}

