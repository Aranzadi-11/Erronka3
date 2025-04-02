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

                    string query = "SELECT sarreraEguna, sarreraOrdua, irteeraEguna, irteeraOrdua FROM erreserbak WHERE idErreserba = @id";

                    using (MySqlCommand cmd = new MySqlCommand(query, conn))

                    {

                        cmd.Parameters.AddWithValue("@id", idErreserba);

                        using (MySqlDataReader reader = cmd.ExecuteReader())

                        {

                            if (reader.Read())

                            {

                                sarreraDataJatorrizkoa = Convert.ToDateTime(reader["sarreraEguna"]);

                                irteeraDataJatorrizkoa = Convert.ToDateTime(reader["irteeraEguna"]);

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

            //Ordu formatua konfiguratu

            dtpSarreraOrdua.Format = DateTimePickerFormat.Custom;

            dtpSarreraOrdua.CustomFormat = "HH:mm";

            dtpSarreraOrdua.ShowUpDown = true;

            dtpSarreraOrdua.MinDate = DateTime.Today.AddHours(16); //Gutxieneko ordua: 16:00

            dtpSarreraOrdua.MaxDate = DateTime.Today.AddHours(23).AddMinutes(30); //Gehienezko ordua: 23:30

            dtpIrteeraOrdua.Format = DateTimePickerFormat.Custom;

            dtpIrteeraOrdua.CustomFormat = "HH:mm";

            dtpIrteeraOrdua.ShowUpDown = true;

            dtpIrteeraOrdua.MinDate = DateTime.Today; //Gutxieneko ordua: 00:00

            dtpIrteeraOrdua.MaxDate = DateTime.Today.AddHours(15); //Gehienezko ordua: 15:00

            //Orduak 30 minutuko tarteetan egokitu

            dtpSarreraOrdua.Value = OrduaEgokitu(dtpSarreraOrdua.Value);

            dtpIrteeraOrdua.Value = OrduaEgokitu(dtpIrteeraOrdua.Value);

            dtpSarreraOrdua.ValueChanged += (sender, e) =>

            {

                dtpSarreraOrdua.Value = OrduaEgokitu(dtpSarreraOrdua.Value);

                if (dtpSarreraOrdua.Value.Hour < 16 || dtpSarreraOrdua.Value.Hour > 23 ||

                   (dtpSarreraOrdua.Value.Hour == 23 && dtpSarreraOrdua.Value.Minute > 30))

                {

                    dtpSarreraOrdua.Value = new DateTime(dtpSarreraOrdua.Value.Year, dtpSarreraOrdua.Value.Month, dtpSarreraOrdua.Value.Day, 16, 0, 0);

                }

            };

            dtpIrteeraOrdua.ValueChanged += (sender, e) =>

            {

                dtpIrteeraOrdua.Value = OrduaEgokitu(dtpIrteeraOrdua.Value);

                if (dtpIrteeraOrdua.Value.Hour > 15)

                {

                    dtpIrteeraOrdua.Value = new DateTime(dtpIrteeraOrdua.Value.Year, dtpIrteeraOrdua.Value.Month, dtpIrteeraOrdua.Value.Day, 15, 0, 0);

                }

            };

        }

        private DateTime OrduaEgokitu(DateTime data)

        {

            //Minutuak 30eko multiploetara biribildu

            int minutuak = data.Minute;

            int minutuEgokituak = (minutuak / 30) * 30;

            return new DateTime(data.Year, data.Month, data.Day, data.Hour, minutuEgokituak, 0);

        }

        private void BtnGorde_Click(object sender, EventArgs e)

        {

            using (MySqlConnection conn = db.GetConnection())

            {

                try

                {

                    db.OpenConnection(conn);

                    string query = "UPDATE erreserbak SET sarreraOrdua = @sarrera, irteeraOrdua = @irteera WHERE idErreserba = @id";

                    using (MySqlCommand cmd = new MySqlCommand(query, conn))

                    {

                        //Data formateatu MySQL-rako

                        string sarreraOrdua = sarreraDataJatorrizkoa.Date.Add(dtpSarreraOrdua.Value.TimeOfDay).ToString("yyyy-MM-dd HH:mm:ss");

                        string irteeraOrdua = irteeraDataJatorrizkoa.Date.Add(dtpIrteeraOrdua.Value.TimeOfDay).ToString("yyyy-MM-dd HH:mm:ss");

                        cmd.Parameters.AddWithValue("@sarrera", sarreraOrdua);

                        cmd.Parameters.AddWithValue("@irteera", irteeraOrdua);

                        cmd.Parameters.AddWithValue("@id", idErreserba);

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

