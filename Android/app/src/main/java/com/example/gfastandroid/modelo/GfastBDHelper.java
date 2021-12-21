package com.example.gfastandroid.modelo;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.NonNull;

import java.util.ArrayList;


public class GfastBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "gfast";
    private static final int DB_VERSION = 1;

    private final SQLiteDatabase db;

    private static final String TABLE_GUITARRAS = "guitarras";
    private static final String GUI_NOME = "gui_nome";
    private static final String GUI_IDSUBCATEGORIA = "gui_idsubcategoria";
    private static final String GUI_IDMARCA = "gui_idmarca";
    private static final String GUI_IDREFERENCIA = "gui_idreferencia";
    private static final String GUI_DESCRICAO = "gui_descricao";
    private static final String GUI_PRECO = "gui_preco";
    private static final String GUI_IVA = "gui_iva";
    private static final String GUI_FOTOPATH = "gui_fotopath";
    private static final String GUI_QRCODEPATH = "gui_qrcodepath";
    private static final String GUI_INATIVO = "gui_inativo";
    private static final String GUI_ID = "gui_id";


    public GfastBDHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }


    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {

        String createGuitarrasTable = "CREATE TABLE " + TABLE_GUITARRAS + "(" + GUI_ID + " INTEGER PRIMARY KEY , " +
                GUI_NOME + " TEXT NOT NULL, " +
                GUI_IDSUBCATEGORIA + " INTEGER NOT NULL, " +
                GUI_IDMARCA + " INTEGER NOT NULL, " +
                GUI_IDREFERENCIA + " INTEGER NOT NULL, " +
                GUI_PRECO + " REAL NOT NULL, " +
                GUI_IVA + " INTEGER NOT NULL, " +
                GUI_FOTOPATH + " TEXT NOT NULL, " +
                GUI_QRCODEPATH + " TEXT NOT NULL, " +
                GUI_INATIVO + " INT NOT NULL, " +
                GUI_DESCRICAO + " TEXT )";


        sqLiteDatabase.execSQL(createGuitarrasTable);


    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

        db.execSQL("DROP TABLE IF EXISTS " + TABLE_GUITARRAS);

        this.onCreate(db);
    }

    public Guitarra adicionarGuitarraBD(Guitarra g) {
        ContentValues values = new ContentValues();
        values.put(GUI_NOME, g.getGui_nome());
        values.put(GUI_IDSUBCATEGORIA, g.getGui_idsubcategoria());
        values.put(GUI_IDMARCA, g.getGui_idmarca());
        values.put(GUI_IDREFERENCIA, g.getGui_idreferencia());
        values.put(GUI_PRECO, g.getGui_preco());
        values.put(GUI_IVA, g.getGui_iva());
        values.put(GUI_FOTOPATH, g.getGui_fotopath());
        values.put(GUI_QRCODEPATH, g.getGui_qrcodepath());
        values.put(GUI_INATIVO, g.getGui_inativo());
        values.put(GUI_DESCRICAO, g.getGui_descricao());

        this.db.insert(TABLE_GUITARRAS, null, values);

        return null;

    }
    public ArrayList<Guitarra> getAllGuitarrasBD() {
        ArrayList<Guitarra> guitarras = new ArrayList<>();

        Cursor cursor = this.db.query(TABLE_GUITARRAS, new String[]{GUI_ID, GUI_NOME, GUI_IDSUBCATEGORIA, GUI_IDMARCA, GUI_IDREFERENCIA, GUI_PRECO, GUI_IVA, GUI_FOTOPATH, GUI_QRCODEPATH, GUI_INATIVO, GUI_DESCRICAO}, null, null, null, null, null);

        if (cursor.moveToFirst()) {
            do {
                Guitarra guitarraaux = new Guitarra(cursor.getInt(0), cursor.getInt(2), cursor.getString(3), cursor.getInt(6), cursor.getFloat(5), cursor.getString(2), cursor.getString(4), cursor.getString(10), cursor.getString(7), cursor.getString(8), cursor.getInt(9));
                //livroaux.setId(cursor.getInt(0));
                guitarras.add(guitarraaux);
            } while (cursor.moveToNext());
        }
        return guitarras;
    }




    public boolean editarGuitarraBD(Guitarra g) {


        ContentValues values = new ContentValues();
        values.put(GUI_NOME, g.getGui_nome());
        values.put(GUI_IDSUBCATEGORIA, g.getGui_idsubcategoria());
        values.put(GUI_IDMARCA, g.getGui_idmarca());
        values.put(GUI_IDREFERENCIA, g.getGui_idreferencia());
        values.put(GUI_PRECO, g.getGui_preco());
        values.put(GUI_IVA, g.getGui_iva());
        values.put(GUI_FOTOPATH, g.getGui_fotopath());
        values.put(GUI_QRCODEPATH, g.getGui_qrcodepath());
        values.put(GUI_INATIVO, g.getGui_inativo());
        values.put(GUI_DESCRICAO, g.getGui_descricao());

        return this.db.update(TABLE_GUITARRAS, values, GUI_ID + "= ?", new String[]{"" + g.getGui_id()}) > 0;

    }

    public boolean removerGuitarraBD(int id) {
        return (this.db.delete(TABLE_GUITARRAS, GUI_ID + "= ?", new String[]{"" + id}) == 1);
    }

    public void removerAllGuitarrasBD() {
        db.delete(TABLE_GUITARRAS, null, null);
    }
}
