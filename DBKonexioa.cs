using MySql.Data.MySqlClient;

using System;
 
namespace BezeroenAPP

{

    public class DBKonexioa

    {

        // Cadena de conexión a la base de datos MySQL

        private string connectionString = "Server=172.16.237.120;Database=erronka3;User Id=Erronka;Password=Erronka3;";

        // Crear y devolver la conexión

        public MySqlConnection GetConnection()

        {

            return new MySqlConnection(connectionString);

        }

        // Abrir la conexión

        public void OpenConnection(MySqlConnection conn)

        {

            if (conn.State != System.Data.ConnectionState.Open)

            {

                conn.Open();

            }

        }

        // Cerrar la conexión

        public void CloseConnection(MySqlConnection conn)

        {

            if (conn.State != System.Data.ConnectionState.Closed)

            {

                conn.Close();

            }

        }

    }

}

