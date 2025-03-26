using System;
using MySql.Data.MySqlClient;
using System.Windows.Forms;
using BezeroenAPP;

namespace BezeroenAPP
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }

        private void btnLogin_Click(object sender, EventArgs e)
        {
            string erabiltzaileIzena = txtErabiltzaileIzena.Text;
            string pasahitza = txtPasahitza.Text;

            // Crear una instancia de la clase DBKonexioa para obtener la conexión
            DBKonexioa db = new DBKonexioa();
            MySqlConnection conn = db.GetConnection();

            try
            {
                // Abrir la conexión con la base de datos
                db.OpenConnection(conn);

                string query = "SELECT COUNT(*) FROM bezeroak WHERE erabiltzaileIzena=@izena AND pasahitza=@pasahitza";
                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    // Añadir parámetros a la consulta para evitar inyecciones SQL
                    cmd.Parameters.AddWithValue("@izena", erabiltzaileIzena);
                    cmd.Parameters.AddWithValue("@pasahitza", pasahitza);

                    // Ejecutar la consulta y obtener el número de coincidencias
                    int count = Convert.ToInt32(cmd.ExecuteScalar());

                    // Verificar si el usuario existe
                    if (count > 0)
                    {
                        MessageBox.Show("Ongi etorri!", "Arrakasta", MessageBoxButtons.OK, MessageBoxIcon.Information);

                        // Abrir la aplicación principal
                        APP nagusia = new APP();
                        nagusia.Show();
                        this.Hide(); // Ocultar el formulario de login
                    }
                    else
                    {
                        MessageBox.Show("Erabiltzaile izena edo pasahitza okerra!", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                }
            }
            catch (Exception ex)
            {
                // Si ocurre un error, mostrarlo al usuario
                MessageBox.Show("Errorea: " + ex.Message, "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            finally
            {
                // Cerrar la conexión
                db.CloseConnection(conn);
            }
        }
    }
}