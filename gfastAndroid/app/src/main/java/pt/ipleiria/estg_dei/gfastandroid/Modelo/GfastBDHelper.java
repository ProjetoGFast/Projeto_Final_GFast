package pt.ipleiria.estg_dei.gfastandroid.Modelo;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;


public class GfastBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "gfast";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;

    private static final String TABLE_GUITARRAS = "guitarras";
    private static final String TITULO = "titulo";
    private static final String SERIE = "serie";
    private static final String AUTOR = "autor";
    private static final String ANO = "ano";
    private static final String CAPA = "capa";
    private static final String ID = "id";

    public GfastBDHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {




    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

    }
}
