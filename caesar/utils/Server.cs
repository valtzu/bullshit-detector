using System;
using System.Net;
using System.Net.Sockets;
using System.Threading.Tasks;

namespace Utils
{
  public class Server
  {
    public int Port { get; set; }
    public event EventHandler<ClientConnectedEventArgs> ClientConnected;

    private TcpListener srv;

    public Task Run()
    {
      this.srv = TcpListener.Create(this.Port);
      this.srv.Start();
      return Task.Run(this.Listen);
    }

    private async Task Listen()
    {
      try
      {
        while (true)
        {
          Console.WriteLine("Waiting for a connection...");
          var client = await this.srv.AcceptTcpClientAsync();
          var e = new ClientConnectedEventArgs { Client = client };
          var task = Task.Run(async () => await OnClientConnected(e));
          if (task.IsFaulted)
            await task;
        }
      }
      catch (SocketException e)
      {
        Console.WriteLine($"SocketException: {e}");
        this.srv.Stop();
      }
    }

    private async Task OnClientConnected(ClientConnectedEventArgs e)
    {
      await Task.Yield();
      ClientConnected?.Invoke(this, e);
    }

    public class ClientConnectedEventArgs : EventArgs
    {
      public TcpClient Client { get; set; }
    }
  }
}
