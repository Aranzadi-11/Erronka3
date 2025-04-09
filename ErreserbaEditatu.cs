using System;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace BezeroenAPP
{
    public partial class ErreserbaEditatu : Form
    {
        private int idErreserba;
        private DBKonexioa db;
        private DateTime sarreraDataJatorrizkoa;
        private DateTime irteeraDataJatorrizkoa;

        public ErreserbaEditatu(int idErreserba, DBKonexioa db)
        {
            this.idErreserba = idErreserba;
            this.db = db;
            InitializeComponent();
            DatuakKargatu();
            DataOrduHautatzaileakKonfiguratu();
        }

        private void DatuakKargatu()
        {
            using (MySqlConnection conn = db.GetConnection())
            {
                try
                {
                    db.OpenConnection(conn);
                    string query = "SELECT sarreraEguna, sarreraOrdua, irteeraEguna, iruzkina, irteeraOrdua FROM erreserbak WHERE idErreserba = @id";
                    using (MySqlCommand cmd = new MySqlCommand(query, conn))
                    {
                        cmd.Parameters.AddWithValue("@id", idErreserba);
                        using (MySqlDataReader reader = cmd.ExecuteReader())
                        {
                            if (reader.Read())
                            {
                                sarreraDataJatorrizkoa = Convert.ToDateTime(reader["sarreraEguna"]);
                                irteeraDataJatorrizkoa = Convert.ToDateTime(reader["irteeraEguna"]);

                                // Sarrera ordua ezarri
                                if (reader["sarreraOrdua"] != DBNull.Value)
                                {
                                    string sarreraOrdua = reader["sarreraOrdua"].ToString();
                                    if (TimeSpan.TryParse(sarreraOrdua, out TimeSpan sarreraTime))
                                    {
                                        dtpSarreraOrdua.Value = sarreraDataJatorrizkoa.Date.Add(sarreraTime).AddSeconds(-sarreraTime.Seconds);
                                    }
                                }
                                else
                                {
                                    dtpSarreraOrdua.Value = sarreraDataJatorrizkoa;
                                }

                                // Irteera ordua ezarri
                                if (reader["irteeraOrdua"] != DBNull.Value)
                                {
                                    string irteeraOrdua = reader["irteeraOrdua"].ToString();
                                    if (TimeSpan.TryParse(irteeraOrdua, out TimeSpan irteeraTime))
                                    {
                                        dtpIrteeraOrdua.Value = irteeraDataJatorrizkoa.Date.Add(irteeraTime).AddSeconds(-irteeraTime.Seconds);
                                    }
                                }
                                else
                                {
                                    dtpIrteeraOrdua.Value = irteeraDataJatorrizkoa;
                                }

                                // Egunaren arabera aukerak bistaratzea
                                DateTime gaur = DateTime.Today;

                                if (gaur < sarreraDataJatorrizkoa)
                                {
                                    // Egun bat edo gehiago sarrera eguna baino lehenago: bi ordu hautatzaileak
                                    dtpSarreraOrdua.Visible = true;
                                    lblSarreraOrdua.Visible = true;
                                    dtpIrteeraOrdua.Visible = true;
                                    lblIrteeraOrdua.Visible = true;
                                    lblIruzkina.Visible = false;
                                    txtIruzkina.Visible = false;
                                }
                                else if (gaur >= sarreraDataJatorrizkoa && gaur <= irteeraDataJatorrizkoa)
                                {
                                    // Sarrera eta irteera egun artean: soilik irteera ordua
                                    dtpSarreraOrdua.Visible = false;
                                    lblSarreraOrdua.Visible = false;
                                    dtpIrteeraOrdua.Visible = true;
                                    lblIrteeraOrdua.Visible = true;
                                    lblIruzkina.Visible = false;
                                    txtIruzkina.Visible = false;
                                }
                                else if (gaur > irteeraDataJatorrizkoa)
                                {
                                    // Irteera eguna igaro da: soilik iruzkina
                                    lblIruzkina.Visible = true;
                                    txtIruzkina.Visible = true;
                                    txtIruzkina.Text = reader["iruzkina"].ToString();
                                    dtpSarreraOrdua.Visible = false;
                                    lblSarreraOrdua.Visible = false;
                                    dtpIrteeraOrdua.Visible = false;
                                    lblIrteeraOrdua.Visible = false;
                                }
                            }
                        }
                    }
                }
                finally
                {
                    db.CloseConnection(conn);
                }
            }
        }

        private void DataOrduHautatzaileakKonfiguratu()
        {
            // Ordu formatua konfiguratu
            dtpSarreraOrdua.Format = DateTimePickerFormat.Custom;
            dtpSarreraOrdua.CustomFormat = "HH:mm";
            dtpSarreraOrdua.ShowUpDown = true;
            dtpSarreraOrdua.MinDate = DateTime.Today.AddHours(16); // Gutxieneko ordua: 16:00
            dtpSarreraOrdua.MaxDate = DateTime.Today.AddHours(23).AddMinutes(30); // Gehienezko ordua: 23:30

            dtpIrteeraOrdua.Format = DateTimePickerFormat.Custom;
            dtpIrteeraOrdua.CustomFormat = "HH:mm";
            dtpIrteeraOrdua.ShowUpDown = true;
            dtpIrteeraOrdua.MinDate = DateTime.Today; // Gutxieneko ordua: 00:00
            dtpIrteeraOrdua.MaxDate = DateTime.Today.AddHours(15); // Gehienezko ordua: 15:00

            // Orduak 30 minutuko tarteetan egokitu
            dtpSarreraOrdua.Value = OrduaEgokitu(dtpSarreraOrdua.Value);
            dtpIrteeraOrdua.Value = OrduaEgokitu(dtpIrteeraOrdua.Value);

            dtpSarreraOrdua.ValueChanged += (sender, e) =>
            {
                // Ordua egokitu 30 minutuko tartera
                dtpSarreraOrdua.Value = OrduaEgokitu(dtpSarreraOrdua.Value);
                if (dtpSarreraOrdua.Value.Hour < 16 || dtpSarreraOrdua.Value.Hour > 23 ||
                   (dtpSarreraOrdua.Value.Hour == 23 && dtpSarreraOrdua.Value.Minute > 30))
                {
                    dtpSarreraOrdua.Value = new DateTime(dtpSarreraOrdua.Value.Year, dtpSarreraOrdua.Value.Month, dtpSarreraOrdua.Value.Day, 16, 0, 0);
                }
            };

            dtpIrteeraOrdua.ValueChanged += (sender, e) =>
            {
                // Ordua egokitu 30 minutuko tartera
                dtpIrteeraOrdua.Value = OrduaEgokitu(dtpIrteeraOrdua.Value);
                if (dtpIrteeraOrdua.Value.Hour > 15)
                {
                    dtpIrteeraOrdua.Value = new DateTime(dtpIrteeraOrdua.Value.Year, dtpIrteeraOrdua.Value.Month, dtpIrteeraOrdua.Value.Day, 15, 0, 0);
                }
            };
        }

        private DateTime OrduaEgokitu(DateTime data)
        {
            // Minutuak 30 minutuko tartera biribildu
            int minutuak = data.Minute;
            int minutuEgokituak = (minutuak / 30) * 30;
            return new DateTime(data.Year, data.Month, data.Day, data.Hour, minutuEgokituak, 0);
        }

        private void TxtIruzkina_TextChanged(object sender, EventArgs e)
        {
            // Iruzkinaren luzera 255 karaktere baino gehiago bada, moztu
            if (txtIruzkina.Text.Length > 255)
            {
                MessageBox.Show("255 baino karaktere gehiago jarri dituzu.", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                txtIruzkina.Text = txtIruzkina.Text.Substring(0, 255);
                txtIruzkina.SelectionStart = txtIruzkina.Text.Length;
            }
        }

        private void TxtIruzkina_Leave(object sender, EventArgs e)
        {
            // Irteeran karaktereak egiaztatu berriro
            if (txtIruzkina.Text.Length > 255)
            {
                MessageBox.Show("255 baino karaktere gehiago jarri dituzu.", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                txtIruzkina.Text = txtIruzkina.Text.Substring(0, 255);
                txtIruzkina.SelectionStart = txtIruzkina.Text.Length;
            }
        }

        private void BtnGorde_Click(object sender, EventArgs e)
        {
            using (MySqlConnection conn = db.GetConnection())
            {
                try
                {
                    db.OpenConnection(conn);
                    string query = "UPDATE erreserbak SET sarreraOrdua = @sarrera, irteeraOrdua = @irteera, iruzkina = @iruzkina WHERE idErreserba = @id";
                    using (MySqlCommand cmd = new MySqlCommand(query, conn))
                    {
                        // Orduak formateatu MySQL-rako
                        string sarreraOrdua = sarreraDataJatorrizkoa.Date.Add(dtpSarreraOrdua.Value.TimeOfDay).ToString("yyyy-MM-dd HH:mm:ss");
                        string irteeraOrdua = irteeraDataJatorrizkoa.Date.Add(dtpIrteeraOrdua.Value.TimeOfDay).ToString("yyyy-MM-dd HH:mm:ss");

                        cmd.Parameters.AddWithValue("@sarrera", sarreraOrdua);
                        cmd.Parameters.AddWithValue("@irteera", irteeraOrdua);
                        cmd.Parameters.AddWithValue("@id", idErreserba);

                        if (lblIruzkina.Visible && txtIruzkina.Visible)
                        {
                            cmd.Parameters.AddWithValue("@iruzkina", txtIruzkina.Text);
                        }
                        else
                        {
                            cmd.Parameters.AddWithValue("@iruzkina", DBNull.Value);
                        }

                        cmd.ExecuteNonQuery();
                    }

                    MessageBox.Show("Aldaketak ongi gorde dira!", "Baieztapena", MessageBoxButtons.OK, MessageBoxIcon.Information);
                    this.Close();
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Errorea aldaketak gordetzean: " + ex.Message);
                }
                finally
                {
                    db.CloseConnection(conn);
                }
            }
        }
    }
}
