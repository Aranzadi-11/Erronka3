namespace BezeroenAPP
{
    partial class ErreserbaEditatu
{
    private System.ComponentModel.IContainer components = null;
    private System.Windows.Forms.Label lblSarreraOrdua;
    private System.Windows.Forms.Label lblIrteeraOrdua;
    private System.Windows.Forms.DateTimePicker dtpSarreraOrdua;
    private System.Windows.Forms.DateTimePicker dtpIrteeraOrdua;
    private System.Windows.Forms.Button btnGorde;

    protected override void Dispose(bool disposing)
    {
        if (disposing && (components != null))
        {
            components.Dispose();
        }
        base.Dispose(disposing);
    }

    private void InitializeComponent()
    {
        this.lblSarreraOrdua = new System.Windows.Forms.Label();
        this.lblIrteeraOrdua = new System.Windows.Forms.Label();
        this.dtpSarreraOrdua = new System.Windows.Forms.DateTimePicker();
        this.dtpIrteeraOrdua = new System.Windows.Forms.DateTimePicker();
        this.btnGorde = new System.Windows.Forms.Button();
        this.SuspendLayout();

        // lblSarreraOrdua
        this.lblSarreraOrdua.AutoSize = true;
        this.lblSarreraOrdua.Location = new System.Drawing.Point(20, 20);
        this.lblSarreraOrdua.Name = "lblSarreraOrdua";
        this.lblSarreraOrdua.Size = new System.Drawing.Size(90, 13);
        this.lblSarreraOrdua.Text = "Sarrera Ordua:";

        // dtpSarreraOrdua
        this.dtpSarreraOrdua.Format = System.Windows.Forms.DateTimePickerFormat.Custom;
        this.dtpSarreraOrdua.CustomFormat = "HH:mm";
        this.dtpSarreraOrdua.ShowUpDown = true;
        this.dtpSarreraOrdua.Location = new System.Drawing.Point(140, 20);
        this.dtpSarreraOrdua.Name = "dtpSarreraOrdua";
        this.dtpSarreraOrdua.Size = new System.Drawing.Size(120, 20);

        // lblIrteeraOrdua
        this.lblIrteeraOrdua.AutoSize = true;
        this.lblIrteeraOrdua.Location = new System.Drawing.Point(20, 60);
        this.lblIrteeraOrdua.Name = "lblIrteeraOrdua";
        this.lblIrteeraOrdua.Size = new System.Drawing.Size(90, 13);
        this.lblIrteeraOrdua.Text = "Irteera Ordua:";

        // dtpIrteeraOrdua
        this.dtpIrteeraOrdua.Format = System.Windows.Forms.DateTimePickerFormat.Custom;
        this.dtpIrteeraOrdua.CustomFormat = "HH:mm";
        this.dtpIrteeraOrdua.ShowUpDown = true;
        this.dtpIrteeraOrdua.Location = new System.Drawing.Point(140, 60);
        this.dtpIrteeraOrdua.Name = "dtpIrteeraOrdua";
        this.dtpIrteeraOrdua.Size = new System.Drawing.Size(120, 20);

        // btnGorde
        this.btnGorde.BackColor = System.Drawing.Color.Blue;
        this.btnGorde.ForeColor = System.Drawing.Color.White;
        this.btnGorde.Location = new System.Drawing.Point(100, 120);
        this.btnGorde.Name = "btnGorde";
        this.btnGorde.Size = new System.Drawing.Size(80, 30);
        this.btnGorde.Text = "Gorde";
        this.btnGorde.UseVisualStyleBackColor = false;
        this.btnGorde.Click += new System.EventHandler(this.BtnGorde_Click);

        // ErreserbaEditatu Form
        this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
        this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
        this.ClientSize = new System.Drawing.Size(300, 180);
        this.Controls.Add(this.lblSarreraOrdua);
        this.Controls.Add(this.dtpSarreraOrdua);
        this.Controls.Add(this.lblIrteeraOrdua);
        this.Controls.Add(this.dtpIrteeraOrdua);
        this.Controls.Add(this.btnGorde);
        this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
        this.MaximizeBox = false;
        this.MinimizeBox = false;
        this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
        this.Text = "Erreserba Editatu";
        this.ResumeLayout(false);
        this.PerformLayout();
    }
}
}