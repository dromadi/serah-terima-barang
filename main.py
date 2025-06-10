import sqlite3
from datetime import datetime
from kivy.app import App
from kivy.lang import Builder
from kivy.uix.screenmanager import ScreenManager, Screen
from kivy.properties import ObjectProperty

KV = '''
ScreenManager:
    HomeScreen:
    AddScreen:

<HomeScreen>:
    name: 'home'
    rv: rv
    BoxLayout:
        orientation: 'vertical'
        RecycleView:
            id: rv
            viewclass: 'TransactionItem'
            data: []
            RecycleBoxLayout:
                orientation: 'vertical'
                default_size: None, dp(48)
                size_hint_y: None
                height: self.minimum_height
        Button:
            text: 'Tambah Transaksi'
            size_hint_y: None
            height: '48dp'
            on_release: root.manager.current = 'add'

<TransactionItem@BoxLayout>:
    tanggal: ''
    nama: ''
    jumlah: 0
    orientation: 'horizontal'
    Label:
        text: root.tanggal
        size_hint_x: .4
    Label:
        text: root.nama
        size_hint_x: .4
    Label:
        text: str(root.jumlah)
        size_hint_x: .2

<AddScreen>:
    name: 'add'
    nama: nama
    jumlah: jumlah
    satuan: satuan
    penyerah: penyerah
    penerima: penerima
    keterangan: keterangan
    BoxLayout:
        orientation: 'vertical'
        padding: dp(10)
        spacing: dp(10)
        TextInput:
            id: nama
            hint_text: 'Nama Barang'
            multiline: False
        TextInput:
            id: jumlah
            hint_text: 'Jumlah'
            input_filter: 'int'
            multiline: False
        TextInput:
            id: satuan
            hint_text: 'Satuan (pcs/kg)'
            multiline: False
        TextInput:
            id: penyerah
            hint_text: 'Penyerah'
            multiline: False
        TextInput:
            id: penerima
            hint_text: 'Penerima'
            multiline: False
        TextInput:
            id: keterangan
            hint_text: 'Keterangan'
            multiline: False
        BoxLayout:
            size_hint_y: None
            height: '48dp'
            spacing: dp(10)
            Button:
                text: 'Simpan'
                on_release: app.save_transaction()
            Button:
                text: 'Batal'
                on_release: root.manager.current = 'home'
'''

class HomeScreen(Screen):
    pass

class AddScreen(Screen):
    pass

class TransactionApp(App):
    def build(self):
        self.db_conn = sqlite3.connect('barang.db')
        self.init_db()
        self.sm = Builder.load_string(KV)
        self.load_transactions()
        return self.sm

    def init_db(self):
        c = self.db_conn.cursor()
        c.execute("""
            CREATE TABLE IF NOT EXISTS transaksi (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                tanggal TEXT,
                nama_barang TEXT,
                jumlah INTEGER,
                satuan TEXT,
                penyerah TEXT,
                penerima TEXT,
                keterangan TEXT
            )""")
        self.db_conn.commit()

    def load_transactions(self):
        c = self.db_conn.cursor()
        c.execute("SELECT tanggal, nama_barang, jumlah FROM transaksi ORDER BY id DESC")
        rows = c.fetchall()
        data = []
        for tanggal, nama_barang, jumlah in rows:
            data.append({'tanggal': tanggal, 'nama': nama_barang, 'jumlah': jumlah})
        self.sm.get_screen('home').rv.data = data

    def save_transaction(self):
        screen = self.sm.get_screen('add')
        nama = screen.nama.text.strip()
        jumlah = screen.jumlah.text.strip()
        satuan = screen.satuan.text.strip()
        penyerah = screen.penyerah.text.strip()
        penerima = screen.penerima.text.strip()
        keterangan = screen.keterangan.text.strip()
        if not nama or not jumlah:
            return
        tanggal = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        c = self.db_conn.cursor()
        c.execute(
            "INSERT INTO transaksi (tanggal, nama_barang, jumlah, satuan, penyerah, penerima, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)",
            (tanggal, nama, int(jumlah), satuan, penyerah, penerima, keterangan)
        )
        self.db_conn.commit()
        screen.nama.text = ''
        screen.jumlah.text = ''
        screen.satuan.text = ''
        screen.penyerah.text = ''
        screen.penerima.text = ''
        screen.keterangan.text = ''
        self.sm.current = 'home'
        self.load_transactions()

if __name__ == '__main__':
    TransactionApp().run()