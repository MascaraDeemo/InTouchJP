using System;

namespace InTouch.Abstractions
{
	public interface IObservableEntityData
	{
		string Id { get; set; }

		DateTimeOffset CreatedAt { get; set; }

		DateTimeOffset UpdatedAt { get; set; }

		byte[] Version { get; set; }
	}
}

