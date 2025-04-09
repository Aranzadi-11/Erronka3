using MySql.Data.MySqlClient;
using System;

namespace BezeroenAPP
{
    public class DBKonexioa
    {
        private string connectionString = "Server=172.16.237.120;Database=erronka3;User Id=Erronka;Password=Erronka3;";

        //Sortu konexioa
        public MySqlConnection GetConnection()
        {
            return new MySqlConnection(connectionString);
        }

        //Konekxioa ireki
        public void OpenConnection(MySqlConnection conn)
        {
            if (conn.State != System.Data.ConnectionState.Open)
            {
                conn.Open();
            }
        }

        //Konekxioa itxi
        public void CloseConnection(MySqlConnection conn)
        {
            if (conn.State != System.Data.ConnectionState.Closed)
            {
                conn.Close();
            }
        }
    }
}