import tkinter as tk
from tkinter import messagebox, ttk
import mysql.connector # type: ignore

def connect_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="balines"
    )

def agregar_reserva(sucursal_id, promo_id, fecha, hora_inicio, hora_final, balas_extras):
    precio = 1000
    try:
        con = connect_db()
        cursor = con.cursor()

        query = "INSERT INTO Reserva (idSucursal, idPromo, fecha, horaInicio, horaFinal, balasExtras, precio) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        cursor.execute(query, (sucursal_id, promo_id, fecha, hora_inicio, hora_final, balas_extras, precio))

        con.commit()
        messagebox.showinfo("Éxito", "Reserva agregada exitosamente")
        con.close()
    except Exception as e:
        messagebox.showerror("Error", str(e))

def cargar_ids_reservas(combobox):
    try:
        con = connect_db()
        cursor = con.cursor()

        query = "SELECT idReserva FROM Reserva"
        cursor.execute(query)
        ids = [str(row[0]) for row in cursor.fetchall()]
        combobox['values'] = ids

        con.close()
    except Exception as e:
        messagebox.showerror("Error", str(e))

def borrar_reserva(reserva_id):
    try:
        con = connect_db()
        cursor = con.cursor()

        query = "DELETE FROM Reserva WHERE idReserva = %s"
        cursor.execute(query, (reserva_id,))

        con.commit()
        messagebox.showinfo("Éxito", "Reserva borrada exitosamente")
        con.close()
    except Exception as e:
        messagebox.showerror("Error", str(e))

def mostrar_reservas(listas):
    try:
        con = connect_db()
        cursor = con.cursor()

        query = "SELECT Reserva.idReserva, Sucursales.direccion, Promos.balasExtras, Promos.tiempoExtra, Promos.precio, Reserva.fecha, Reserva.horaInicio, Reserva.horaFinal, Reserva.balasExtras, Reserva.precio FROM Reserva JOIN Sucursales ON Reserva.idSucursal = Sucursales.idSucursal JOIN Promos ON Reserva.idPromo = Promos.idPromo"
        cursor.execute(query)
        rows = cursor.fetchall()

        for lista in listas:
            lista.delete(0, tk.END)
            
        for row in rows:
            for idx, value in enumerate(row):
                listas[idx].insert(tk.END, str(value))

        con.close()
    except Exception as e:
        messagebox.showerror("Error", str(e))

root = tk.Tk()
root.title("Gestión de Reservas de Paintball")
root.geometry("900x400")

notebook = ttk.Notebook(root)
notebook.pack(pady=10, expand=True)

tab1 = ttk.Frame(notebook)
notebook.add(tab1, text="Agregar Reserva")

tk.Label(tab1, text="Sucursal ID:").grid(row=0, column=0, padx=10, pady=5)
sucursal_entry = tk.Entry(tab1)
sucursal_entry.grid(row=0, column=1, padx=10, pady=5)

tk.Label(tab1, text="Promo ID:").grid(row=1, column=0, padx=10, pady=5)
promo_entry = tk.Entry(tab1)
promo_entry.grid(row=1, column=1, padx=10, pady=5)

tk.Label(tab1, text="Fecha (YYYY-MM-DD):").grid(row=2, column=0, padx=10, pady=5)
fecha_entry = tk.Entry(tab1)
fecha_entry.grid(row=2, column=1, padx=10, pady=5)

tk.Label(tab1, text="Hora Inicio (HH:MM:SS):").grid(row=3, column=0, padx=10, pady=5)
hora_inicio_entry = tk.Entry(tab1)
hora_inicio_entry.grid(row=3, column=1, padx=10, pady=5)

tk.Label(tab1, text="Hora Final (HH:MM:SS):").grid(row=4, column=0, padx=10, pady=5)
hora_final_entry = tk.Entry(tab1)
hora_final_entry.grid(row=4, column=1, padx=10, pady=5)

tk.Label(tab1, text="Balas Extras:").grid(row=5, column=0, padx=10, pady=5)
balas_entry = tk.Entry(tab1)
balas_entry.grid(row=5, column=1, padx=10, pady=5)

tk.Label(tab1, text="Precio:").grid(row=6, column=0, padx=10, pady=5)
precio_entry = tk.Entry(tab1)
precio_entry.grid(row=6, column=1, padx=10, pady=5)

tk.Button(tab1, text="Agregar Reserva", command=lambda: agregar_reserva(
    sucursal_entry.get(), promo_entry.get(), fecha_entry.get(), hora_inicio_entry.get(),
    hora_final_entry.get(), balas_entry.get())).grid(row=7, column=0, columnspan=2, pady=10)

tab2 = ttk.Frame(notebook)
notebook.add(tab2, text="Borrar Reserva")

tk.Label(tab2, text="Seleccione ID de Reserva:").grid(row=0, column=0, padx=10, pady=5)
id_reserva_combobox = ttk.Combobox(tab2, state="readonly")
id_reserva_combobox.grid(row=0, column=1, padx=10, pady=5)

cargar_ids_reservas(id_reserva_combobox)

tk.Button(tab2, text="Borrar Reserva", command=lambda: borrar_reserva(id_reserva_combobox.get())).grid(row=1, column=0, columnspan=2, pady=10)

tab3 = ttk.Frame(notebook)
notebook.add(tab3, text="Mostrar Reservas")

columnas = ["ID", "Sucursal", "Balas Extras\nPromo", "Tiempo Extra\nPromo", "Precio\nPromo", "Fecha", "Hora Inicio", "Hora Final", "Balas Extras", "Precio"]

for idx, columna in enumerate(columnas):
    tk.Label(tab3, text=columna, font=('Arial', 10, 'bold')).grid(row=0, column=idx, padx=5, pady=5)

listas = []
for idx in range(len(columnas)):
    lista = tk.Listbox(tab3, width=15, height=10, selectbackground="lightblue")
    lista.grid(row=1, column=idx, padx=5, pady=5)
    listas.append(lista)

tk.Button(tab3, text="Cargar Reservas", command=lambda: mostrar_reservas(listas)).grid(row=2, column=0, columnspan=len(columnas), pady=10)

root.mainloop()