import sqlite3
from kivy.app import App
from kivy.lang import Builder

KV = '''
BoxLayout:
    orientation: 'vertical'
    padding: 20
    spacing: 10

    TextInput:
        id: barang
        hint_text: 'Nama Barang'

    TextInput:
        id: penerima
        hint_text: 'Penerima'

    Button:
        text: 'Simpan'
        on_release: app.save(barang.text, penerima.text)

    Label:
        id: msg
        text: app.message
'''

class SerahTerimaApp(App):
    message = ''

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.conn = sqlite3.connect('data.db')
        self.conn.execute('CREATE TABLE IF NOT EXISTS log(barang TEXT, penerima TEXT)')

    def build(self):
        return Builder.load_string(KV)

    def save(self, barang, penerima):
        self.conn.execute('INSERT INTO log(barang, penerima) VALUES (?, ?)', (barang, penerima))
        self.conn.commit()
        self.message = f'Tersimpan: {barang} untuk {penerima}'
        self.root.ids.msg.text = self.message

    def on_stop(self):
        self.conn.close()

if __name__ == '__main__':
    SerahTerimaApp().run()
