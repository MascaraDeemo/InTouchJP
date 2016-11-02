using System;

namespace InTouch.Abstractions
{

	public class DataSyncErrorEventArgs<T> : EventArgs
	{
		public DataSyncErrorEventArgs(T localQueuedItem, T conflictedServiceItem)
		{
			_LocalQueuedItem = localQueuedItem;
			_ConflictedServiceItem = conflictedServiceItem;
		}

		private T _LocalQueuedItem;
		public T LocalQueuedItem
		{
			get { return _LocalQueuedItem; }
		}

		private T _ConflictedServiceItem;
		public T ConflictedServiceItem
		{
			get { return _ConflictedServiceItem; }
		}
	}
}

