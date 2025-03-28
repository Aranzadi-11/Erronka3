using System;

using System.Windows.Forms;

namespace BezeroenAPP

{

    public partial class APP : Form

    {

        //Erabiltzailaren datuak gorde

        private string userIzena;

        private string userAbizena;

        //Erabiltzailearen izena eta abizena jasotzen ditu

        public APP(string izena, string abizena)

        {

            InitializeComponent();

            this.userIzena = izena;

            this.userAbizena = abizena;

            ActualizarHeader();

        }

        private void ActualizarHeader()

        {

            lblTitle.Text = $"Kaixo, {userIzena} {userAbizena}";

        }

    }

}

