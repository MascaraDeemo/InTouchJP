﻿using System.Net.Http;
using InTouch.Abstractions;

namespace InTouch.Common.Droid
{
	public class HttpClientHandlerFactory : IHttpClientHandlerFactory
	{
		public HttpClientHandler GetHttpClientHandler()
		{
			// not needed on Android
			return null;
		}
	}
}

