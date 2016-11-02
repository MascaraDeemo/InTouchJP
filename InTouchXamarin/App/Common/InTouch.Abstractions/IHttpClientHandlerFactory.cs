using System.Net.Http;

namespace InTouch.Abstractions
{
	public interface IHttpClientHandlerFactory
	{
		HttpClientHandler GetHttpClientHandler();
	}
}

