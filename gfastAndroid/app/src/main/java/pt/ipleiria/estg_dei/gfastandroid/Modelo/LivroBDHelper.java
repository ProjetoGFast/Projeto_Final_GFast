package pt.ipleiria.estg_dei.gfastandroid.Modelo;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class LivroBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "dblivros";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;

    private static final String TABLE_NAME = "livros";
    private static final String TITULO = "titulo";
    private static final String SERIE = "serie";
    private static final String AUTOR = "autor";
    private static final String ANO = "ano";
    private static final String CAPA = "capa";
    private static final String ID = "id";


    public LivroBDHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }


    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {

        String createLivroTable = "CREATE TABLE " + TABLE_NAME + "(" + ID + " INTEGER PRIMARY KEY , " +
                TITULO + " TEXT NOT NULL, " +
                SERIE + " TEXT NOT NULL, " +
                AUTOR + " TEXT NOT NULL, " +
                ANO + " INTEGER NOT NULL, " +
                CAPA + " TEXT )";

        sqLiteDatabase.execSQL(createLivroTable);

    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);

        this.onCreate(db);

    }

    public Livro adicionarLivroBD(Livro l)
    {
        ContentValues values = new ContentValues();
        values.put(TITULO, l.getTitulo());
        values.put(SERIE, l.getSerie());
        values.put(AUTOR, l.getAutor());
        values.put(ANO, l.getAno());
        values.put(CAPA, l.getCapa());

        this.db.insert(TABLE_NAME, null, values);

        return null;

    }

    public boolean editarLivroBD(Livro l)
    {


        ContentValues values = new ContentValues();
        values.put(TITULO, l.getTitulo());
        values.put(SERIE, l.getSerie());
        values.put(AUTOR, l.getAutor());
        values.put(ANO, l.getAno());
        values.put(CAPA, l.getCapa());

        return this.db.update(TABLE_NAME, values, ID + "= ?", new String[]{"" + l.getId()}) > 0;

    }

    public boolean removerLivroBD(int id)
    {
        return (this.db.delete(TABLE_NAME, ID + "= ?", new String[]{"" + id}) == 1);
    }

    public ArrayList<Livro> getAllLivrosBD()
    {
        ArrayList<Livro> livros = new ArrayList<>();

        Cursor cursor = this.db.query(TABLE_NAME, new String[]{ID, TITULO , SERIE , AUTOR, ANO , CAPA}, null, null, null, null, null);

        if(cursor.moveToFirst())
        {
            do{
                Livro livroaux = new Livro(cursor.getInt(0),cursor.getInt(4), cursor.getString(5), cursor.getString(1), cursor.getString(2), cursor.getString(3));
                //livroaux.setId(cursor.getInt(0));
                livros.add(livroaux);
            }while(cursor.moveToNext());
        }
        return livros;
    }

    public void removerAllLivroBD()
    {
        db.delete(TABLE_NAME, null, null);
    }
}
