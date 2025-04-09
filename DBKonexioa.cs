using MySql.Data.MySqlClient;
using System;

namespace BezeroenAPP
{
    public class DBKonexioa
    {
        private string connectionString = "Server=localhost;Database=erronka3;User Id=root;Password=;";

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