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

            panelReservas.Controls.Clear();

            using (MySqlConnection conn = db.GetConnection())

            {

                db.OpenConnection(conn);

                string query = @"

        SELECT e.idErreserba, l.izena AS Logela, b.erabiltzaileIzena AS Erabiltzailea, 

            DATE_FORMAT(e.erreserbaEguna, '%Y-%m-%d') AS erreserbaEguna, 

            DATE_FORMAT(e.sarreraEguna, '%Y/%m/%d') AS sarreraEguna, 

            DATE_FORMAT(e.irteeraEguna, '%Y/%m/%d') AS irteeraEguna, 

            TIME(e.sarreraOrdua) AS sarreraOrdua, 

            TIME(e.irteeraOrdua) AS irteeraOrdua, e.iruzkina, e.Prezioa

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

                            Label lblEzErreserba = new Label

                            {

                                Text = "Ez duzu erreserbarik.",

                                AutoSize = true,

                                ForeColor = Color.Blue,

                                Font = new Font("Arial", 14F, FontStyle.Bold),

                                TextAlign = ContentAlignment.MiddleCenter,

                                Dock = DockStyle.Fill

                            };

                            panelReservas.Controls.Add(lblEzErreserba);

                        }

                        else

                        {

                            while (reader.Read())

                            {

                                int idErreserba = Convert.ToInt32(reader["idErreserba"]);

                                Panel erreserbaPanel = new Panel

                                {

                                    Width = panelReservas.Width - 40,

                                    Height = 170,

                                    BackColor = Color.White,

                                    Margin = new Padding(10),

                                    BorderStyle = BorderStyle.FixedSingle,

                                    Tag = idErreserba

                                };

                                Panel panelHeader = new Panel

                                {

                                    Dock = DockStyle.Top,

                                    Height = 35,

                                    BackColor = Color.Black,

                                    Cursor = Cursors.Hand // Indica que es clickeable

                                };

                                Label lblErreserbaHeader = new Label

                                {

                                    Text = $"Erreserba #{idErreserba}",

                                    ForeColor = Color.White,

                                    Font = new Font("Arial", 12F, FontStyle.Bold),

                                    Dock = DockStyle.Fill,

                                    TextAlign = ContentAlignment.MiddleLeft,

                                    Padding = new Padding(10),

                                    Cursor = Cursors.Hand

                                };

                                // Evento para abrir el formulario al hacer clic en el header o el label

                                EventHandler abrirFormulario = (sender, e) =>

                                {

                                    ErreserbaEditatu editForm = new ErreserbaEditatu(idErreserba, db);

                                    editForm.ShowDialog();

                                    ErreserbakKargatu(); // Recargar reservas tras editar

                                };

                                panelHeader.Click += abrirFormulario;

                                lblErreserbaHeader.Click += abrirFormulario;

                                panelHeader.Controls.Add(lblErreserbaHeader);

                                TableLayoutPanel infoTable = new TableLayoutPanel

                                {

                                    Dock = DockStyle.Fill,

                                    ColumnCount = 2,

                                    RowCount = 5,

                                    Padding = new Padding(10)

                                };

                                infoTable.ColumnStyles.Add(new ColumnStyle(SizeType.Percent, 50F));

                                infoTable.ColumnStyles.Add(new ColumnStyle(SizeType.Percent, 50F));

                                infoTable.Controls.Add(CreateDetailLabel("Logela:", reader["Logela"].ToString()), 0, 0);

                                infoTable.SetColumnSpan(infoTable.Controls[infoTable.Controls.Count - 1], 2);

                                infoTable.Controls.Add(CreateDetailLabel("Prezioa:", reader["Prezioa"].ToString() + "€"), 0, 1);

                                infoTable.SetColumnSpan(infoTable.Controls[infoTable.Controls.Count - 1], 2);

                                infoTable.Controls.Add(CreateDetailLabel("Sarrera eguna:", reader["sarreraEguna"].ToString()), 0, 2);

                                infoTable.Controls.Add(CreateDetailLabel("Irteera eguna:", reader["irteeraEguna"].ToString()), 1, 2);

                                infoTable.Controls.Add(CreateDetailLabel("Sarrera ordua:", reader["sarreraOrdua"] == DBNull.Value ? "--:--" : reader["sarreraOrdua"].ToString()), 0, 3);

                                infoTable.Controls.Add(CreateDetailLabel("Irteera ordua:", reader["irteeraOrdua"] == DBNull.Value ? "--:--" : reader["irteeraOrdua"].ToString()), 1, 3);

                                infoTable.Controls.Add(CreateDetailLabel("Iruzkina:", reader["iruzkina"].ToString()), 0, 4);

                                infoTable.SetColumnSpan(infoTable.Controls[infoTable.Controls.Count - 1], 2);

                                erreserbaPanel.Controls.Add(infoTable);

                                erreserbaPanel.Controls.Add(panelHeader);

                                panelReservas.Controls.Add(erreserbaPanel);

                            }

                        }

                    }

                }

                db.CloseConnection(conn);

            }

        }

        //Etiketa bat sortu

        private Label CreateDetailLabel(string label, string value)

        {

            return new Label

            {

                Text = $"{label} {value}",

                AutoSize = true,

                Font = new Font("Arial", 10F, FontStyle.Regular),

                ForeColor = Color.Black,

                Padding = new Padding(2)

            };

        }

    }

}

