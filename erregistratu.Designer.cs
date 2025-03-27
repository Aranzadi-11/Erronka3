using System.Windows.Forms;
using System;

namespace BezeroenAPP
{
    partial class Erregistratu
    {
        private System.ComponentModel.IContainer components = null;
        private System.Windows.Forms.TextBox txtIzena;
        private System.Windows.Forms.TextBox txtAbizena;
        private System.Windows.Forms.TextBox txtErabiltzaileIzena;
        private System.Windows.Forms.TextBox txtPasahitza;
        private System.Windows.Forms.TextBox txtJaiotzeData;
        private System.Windows.Forms.TextBox txtEmaila;
        private System.Windows.Forms.Button btnErregistratu;
        private System.Windows.Forms.Button btnLogin;
        private System.Windows.Forms.Panel panelHeader;
        private System.Windows.Forms.Label lblTitle;
        private System.Windows.Forms.Label lblIzena;
        private System.Windows.Forms.Label lblAbizena;
        private System.Windows.Forms.Label lblErabiltzaileIzena;
        private System.Windows.Forms.Label lblPasahitza;
        private System.Windows.Forms.Label lblJaiotzeData;
        private System.Windows.Forms.Label lblEmaila;

        private void InitializeComponent()
        {
            this.txtIzena = new System.Windows.Forms.TextBox();
            this.txtAbizena = new System.Windows.Forms.TextBox();
            this.txtErabiltzaileIzena = new System.Windows.Forms.TextBox();
            this.txtPasahitza = new System.Windows.Forms.TextBox();
            this.txtJaiotzeData = new System.Windows.Forms.TextBox();
            this.txtEmaila = new System.Windows.Forms.TextBox();
            this.btnErregistratu = new System.Windows.Forms.Button();
            this.btnLogin = new System.Windows.Forms.Button();
            this.panelHeader = new System.Windows.Forms.Panel();
            this.lblTitle = new System.Windows.Forms.Label();
            this.lblIzena = new System.Windows.Forms.Label();
            this.lblAbizena = new System.Windows.Forms.Label();
            this.lblErabiltzaileIzena = new System.Windows.Forms.Label();
            this.lblPasahitza = new System.Windows.Forms.Label();
            this.lblJaiotzeData = new System.Windows.Forms.Label();
            this.lblEmaila = new System.Windows.Forms.Label();
            this.SuspendLayout();

            //Header
            this.panelHeader.BackColor = System.Drawing.Color.Blue;
            this.panelHeader.Dock = System.Windows.Forms.DockStyle.Top;
            this.panelHeader.Height = 50;
            this.panelHeader.Controls.Add(this.lblTitle);

            //Titulua
            this.lblTitle.Text = "Erregistratu";
            this.lblTitle.ForeColor = System.Drawing.Color.White;
            this.lblTitle.Font = new System.Drawing.Font("Arial", 16F, System.Drawing.FontStyle.Bold);
            this.lblTitle.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblTitle.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;

            //Izena, abizena, erabiltzaile izena, pasahitza, jaiotze data eta emaila 
            this.lblIzena.Text = "Izena:";
            this.lblIzena.Location = new System.Drawing.Point(30, 90);
            this.txtIzena.Location = new System.Drawing.Point(150, 90);
            this.txtIzena.Size = new System.Drawing.Size(200, 22);

            this.lblAbizena.Text = "Abizena:";
            this.lblAbizena.Location = new System.Drawing.Point(30, 130);
            this.txtAbizena.Location = new System.Drawing.Point(150, 130);
            this.txtAbizena.Size = new System.Drawing.Size(200, 22);

            this.lblErabiltzaileIzena.Text = "Erabiltzaile Izena:";
            this.lblErabiltzaileIzena.Location = new System.Drawing.Point(30, 170);
            this.txtErabiltzaileIzena.Location = new System.Drawing.Point(150, 170);
            this.txtErabiltzaileIzena.Size = new System.Drawing.Size(200, 22);

            this.lblPasahitza.Text = "Pasahitza:";
            this.lblPasahitza.Location = new System.Drawing.Point(30, 210);
            this.txtPasahitza.Location = new System.Drawing.Point(150, 210);
            this.txtPasahitza.Size = new System.Drawing.Size(200, 22);

            this.lblJaiotzeData.Text = "Jaiotze Data (YYYY/MM/DD):";
            this.lblJaiotzeData.Location = new System.Drawing.Point(30, 250);
            this.txtJaiotzeData.Location = new System.Drawing.Point(150, 250);
            this.txtJaiotzeData.Size = new System.Drawing.Size(200, 22);

            this.lblEmaila.Text = "Emaila:";
            this.lblEmaila.Location = new System.Drawing.Point(30, 290);
            this.txtEmaila.Location = new System.Drawing.Point(150, 290);
            this.txtEmaila.Size = new System.Drawing.Size(200, 22);

            //Login botoia
            this.btnLogin.Text = "Saioa Hasi";
            this.btnLogin.Location = new System.Drawing.Point(75, 330);
            this.btnLogin.Size = new System.Drawing.Size(250, 40);
            this.btnLogin.BackColor = System.Drawing.Color.Blue;
            this.btnLogin.ForeColor = System.Drawing.Color.White;
            this.btnLogin.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnLogin.Font = new System.Drawing.Font("Arial", 12, System.Drawing.FontStyle.Bold);
            this.btnLogin.Click += new System.EventHandler(this.btnLogin_Click);

            //Erregistratu botoia
            this.btnErregistratu.Text = "Erregistratu";
            this.btnErregistratu.Location = new System.Drawing.Point(75, 380);
            this.btnErregistratu.Size = new System.Drawing.Size(250, 40);
            this.btnErregistratu.BackColor = System.Drawing.Color.Green;
            this.btnErregistratu.ForeColor = System.Drawing.Color.White;
            this.btnErregistratu.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnErregistratu.Font = new System.Drawing.Font("Arial", 12, System.Drawing.FontStyle.Bold);
            this.btnErregistratu.Click += new System.EventHandler(this.btnErregistratu_Click);

            this.ClientSize = new System.Drawing.Size(400, 450);
            this.Controls.Add(this.panelHeader);
            this.Controls.Add(this.btnErregistratu);
            this.Controls.Add(this.btnLogin);
            this.Controls.Add(this.txtEmaila);
            this.Controls.Add(this.txtJaiotzeData);
            this.Controls.Add(this.txtPasahitza);
            this.Controls.Add(this.txtErabiltzaileIzena);
            this.Controls.Add(this.txtAbizena);
            this.Controls.Add(this.txtIzena);
            this.Controls.Add(this.lblIzena);
            this.Controls.Add(this.lblAbizena);
            this.Controls.Add(this.lblErabiltzaileIzena);
            this.Controls.Add(this.lblPasahitza);
            this.Controls.Add(this.lblJaiotzeData);
            this.Controls.Add(this.lblEmaila);
            this.Name = "Erregistratu";
            this.Text = "Erregistratu";
            this.StartPosition = FormStartPosition.CenterScreen;
            this.ResumeLayout(false);
            this.PerformLayout();
        }

        //Botoiari emandakoan balidatu
        private void btnErregistratu_Click1(object sender, EventArgs e)
        {
            //Jaiotze data balidatu
            string jaiotzeData = txtJaiotzeData.Text;
            if (!System.Text.RegularExpressions.Regex.IsMatch(jaiotzeData, @"^\d{4}/\d{2}/\d{2}$"))
            {
                MessageBox.Show("Jaiotze data egonkorra izan behar du (YYYY/MM/DD formatua).");
                return;
            }

            //Emaila balidatu
            string email = txtEmaila.Text;
            if (!email.Contains("@"))
            {
                MessageBox.Show("Emailak '@' izan behar du.");
                return;
            }

            //Balidazioa ondo egin bada, erabiltzailea erregistratu
            MessageBox.Show("Erregistratu zaitez!");
        }
    }
}