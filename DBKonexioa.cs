using System;
using System.Data.SqlClient;

namespace BezeroenAPP
{
    public class DBKonexioa
    {
        private static string connectionString = "Server=172.16.237.120:3306;Database=erronka3;User Id=Erronka;Password=Erronka3;";

        public static SqlConnection LortuKonexioa()
        {
            SqlConnection conn = new SqlConnection(connectionString);
            return conn;
        }
    }
}
