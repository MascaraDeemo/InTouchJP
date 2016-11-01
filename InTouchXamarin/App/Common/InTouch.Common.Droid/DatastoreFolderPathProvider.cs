using System;
using InTouch.Abstractions;

namespace InTouch.Common.Droid
{
	public class DatastoreFolderPathProvider : IDatastoreFolderPathProvider
	{
		public string GetPath()
		{
			return Environment.GetFolderPath(Environment.SpecialFolder.Personal);
		}
	}
}

