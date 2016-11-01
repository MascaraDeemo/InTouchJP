﻿using System.Net.Http;

namespace InTouch.Abstractions
{
	/// <summary>
	/// A factory that produces HttpClientHandlers.
	/// </summary>
	public interface IHttpClientHandlerFactory
	{
		/// <summary>
		/// Gets a HttpClientHandler.
		/// </summary>
		/// <returns>A HttpClientHandler.</returns>
		HttpClientHandler GetHttpClientHandler();
	}
}

