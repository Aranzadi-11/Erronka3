using System;
using System.Data;
using System.Drawing;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace BezeroenAPP
{
    public partial class APP : Form
    {
        private string userIzena;
        private string userAbizena;
        private DBKonexioa db;

        public APP(string izena, string abizena)
        {
            InitializeComponent();
            this.userIzena = izena;
            this.userAbizena = abizena;
            this.db = new DBKonexioa();
            HeaderEguneratu();
            ErreserbakKargatu();
        }

        private void HeaderEguneratu()
        {
            lblTitle.Text = $"Kaixo, {userIzena} {userAbizena}";
        }

        private void ErreserbakKargatu()
        {
            panelReservas.Controls.Clear(); //Panela garbitu aurreko bezeroaren erreserbak ez erakusteko

            using (MySqlConnection conn = db.GetConnection())
            {
                db.OpenConnection(conn);

                string query = @"
                    SELECT e.idErreserba, l.izena AS Logela, b.erabiltzaileIzena AS Erabiltzailea, 
                           e.erreserbaEguna, e.sarreraEguna, e.irteeraEguna, 
                           e.sarreraOrdua, e.irteeraOrdua, e.iruzkina, e.Prezioa
                    FROM erreserbak e
                    JOIN bezeroak b ON e.idBezeroa = b.idBezeroa
                    JOIN logelak l ON e.idLogela = l.idLogela
                    WHERE b.erabiltzaileIzena = @izena;";

                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    cmd.Parameters.AddWithValue("@izena", userIzena);
                    using (MySqlDataReader reader = cmd.ExecuteReader())
                    {
                        if (!reader.HasRows)
                        {
                            //Erreserba ez badago, mezua erakutsi
                            Label lblNoReservas = new Label
                            {
                                Text = "Ez duzu erreserbarik.",
                                AutoSize = true,
                                ForeColor = Color.Red,
                                Font = new Font("Arial", 14F, FontStyle.Bold),
                                TextAlign = ContentAlignment.MiddleCenter,
                                Dock = DockStyle.Fill
                            };
                            panelReservas.Controls.Add(lblNoReservas);
                        }
                        else
                        {
                            //Erreserbak, bat bestearen gainean jarri
                            while (reader.Read())
                            {
                                Panel reservaPanel = new Panel
                                {
                                    Width = panelReservas.Width - 20, //Zabalera handitu
                                    Height = 150, //Erreserba bakoitzaren altuera
                                    BorderStyle = BorderStyle.FixedSingle,
                                    Padding = new Padding(5),
                                    Margin = new Padding(5) //Erreserben arteko tartea
                                };

                                Label lblReserva = new Label
                                {
                                    Text = $"Erreserba zenbakia: {reader["idErreserba"]}\n" +
                                           $"Logela: {reader["Logela"]}\n" +
                                           $"Erreserba eguna: {reader["erreserbaEguna"]}\n" +
                                           $"Sarrera ordua: {reader["sarreraEguna"]}\n" +
                                           $"Irteera eguna: {reader["irteeraEguna"]}\n" +
                                           $"Sarrera ordua{reader["sarreraOrdua"]}\n" +
                                           $"Irteera ordua: {reader["irteeraOrdua"]}\n" +
                                           $"Prezioa: {reader["Prezioa"]}€\n" +
                                           $"Iruzkina: {reader["iruzkina"]}",
                                    AutoSize = true,
                                    Font = new Font("Arial", 10F),
                                    TextAlign = ContentAlignment.TopLeft
                                };

                                reservaPanel.Controls.Add(lblReserva);
                                panelReservas.Controls.Add(reservaPanel);
                            }
                        }
                    }
                }

                db.CloseConnection(conn);
            }
        }
    }
}