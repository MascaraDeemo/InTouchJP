using System;
namespace InTouch.Abstractions
{

	public delegate void DataSyncErrorEventHandler<T>(object sender, DataSyncErrorEventArgs<T> e);
}

