using System;
using System.Net;
using System.Net.Sockets;
using System.Threading;
using System.Threading.Tasks;

namespace Utils
{
  public class Server
  {
    public int Port { get; set; }
    public event EventHandler<ClientConnectedEventArgs> ClientConnected;

    private TcpListener srv;
    private CancellationTokenSource cts;
    private Task runner;

    public void Start()
    {
      this.cts = new CancellationTokenSource();
      this.runner = this.Run(this.cts.Token);
    }

    public void Wait()
    {
      if (this.runner == null || this.runner.IsFaulted)
        return;

      this.runner.Wait();
      this.runner = null;
    }

    public void Stop()
    {
      this.cts.Cancel();
    }

    private Task Run(CancellationToken ct)
    {
      this.srv = TcpListener.Create(this.Port);
      this.srv.Start();

      return Task.Run(() => this.Listen(ct));
    }

    private void Listen(CancellationToken ct)
    {
      Console.WriteLine($"Server started at port {this.Port}");

      try
      {
        while (true)
        {
          var clientTask = this.srv.AcceptTcpClientAsync();
          clientTask.Wait(ct);
          ct.ThrowIfCancellationRequested();

          var e = new ClientConnectedEventArgs { Client = clientTask.Result };
          Task.Run(async () => await OnClientConnected(e), ct);
        }
      }
      catch (OperationCanceledException)
      {
        this.srv.Stop();
      }

      Console.WriteLine($"Server stopped");
    }

    private async Task OnClientConnected(ClientConnectedEventArgs e)
    {
      await Task.Yield();
      this.ClientConnected?.Invoke(this, e);
    }

    public class ClientConnectedEventArgs : EventArgs
    {
      public TcpClient Client { get; set; }
    }
  }
}
