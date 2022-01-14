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


    //Tabela Guitarras
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



    //Tabela User
    private static final String TABLE_USER = "user";
    private static final String ID = "id";
    private static final String USERNAME = "username";
    private static final String AUTH_KEY = "auth_key";
    private static final String PASSWORD_RESET_TOKEN = "password_reset_token";
    private static final String EMAIL = "email";
    private static final String VERIFICATION_TOKEN = "verification_token";
    private static final String US_NOME = "us_nome";
    private static final String US_APELIDO = "us_apelido";
    private static final String US_CIDADE = "us_cidade";
    private static final String US_TELEMOVEL = "us_telemovel";
    private static final String US_CONTRIBUINTE = "us_contribuinte";
    private static final String US_PONTOS = "us_pontos";



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


        String createUserTable = "CREATE TABLE " + TABLE_USER + "(" + ID + " INTEGER PRIMARY KEY , " +
                USERNAME + " TEXT NOT NULL, " +
                AUTH_KEY + " TEXT NOT NULL, " +
                PASSWORD_RESET_TOKEN + " TEXT NOT NULL, " +
                EMAIL + " TEXT NOT NULL, " +
                VERIFICATION_TOKEN + " TEXT NOT NULL, " +
                US_NOME + " TEXT NOT NULL, " +
                US_APELIDO + " TEXT NOT NULL, " +
                US_CIDADE + " TEXT NOT NULL, " +
                US_TELEMOVEL + " INTEGER NOT NULL, " +
                US_PONTOS + " INTEGER NOT NULL, " +
                US_CONTRIBUINTE + " INTEGER NOT NULL )";


        sqLiteDatabase.execSQL(createUserTable);





    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

        db.execSQL("DROP TABLE IF EXISTS " + TABLE_GUITARRAS);

        this.onCreate(db);

        db.execSQL("DROP TABLE IF EXISTS " + TABLE_USER);

        this.onCreate(db);
    }
//#########################################GUITARRAS############################################\\

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
                Guitarra guitarraaux = new Guitarra(cursor.getInt(0), cursor.getInt(2), cursor.getString(3), cursor.getInt(6), cursor.getFloat(5), cursor.getString(1), cursor.getString(4), cursor.getString(10), cursor.getString(7), cursor.getString(8), cursor.getInt(9));
                guitarras.add(guitarraaux);
            } while (cursor.moveToNext());
        }
        return guitarras;
    }

    public void removerAllGuitarrasBD() {
        db.delete(TABLE_GUITARRAS, null, null);
    }

    //#########################################USER############################################\\

    public User adicionarUserBD(User u) {
        ContentValues values = new ContentValues();
        values.put(USERNAME, u.getUsername());
        values.put(AUTH_KEY, u.getAuth_key());
        values.put(PASSWORD_RESET_TOKEN, u.getPassword_reset_token());
        values.put(EMAIL, u.getEmail());
        values.put(VERIFICATION_TOKEN, u.getVerification_token());
        values.put(US_NOME, u.getUs_nome());
        values.put(US_APELIDO, u.getUs_apelido());
        values.put(US_CIDADE, u.getUs_cidade());
        values.put(US_TELEMOVEL, u.getUs_telemovel());
        values.put(US_PONTOS, u.getUs_pontos());
        values.put(US_CONTRIBUINTE, u.getUs_contribuinte());

        this.db.insert(TABLE_USER, null, values);

        return null;



    }
    public boolean removerUserBD(int id) {
        return (this.db.delete(TABLE_USER, ID + "= ?", new String[]{"" + id}) == 1);
    }
    public void removelAllUser() {
        db.delete(TABLE_GUITARRAS, null, null);
    }


    public User getUser() {

        User useraux;

        Cursor cursor = this.db.query(TABLE_USER, new String[]{ID, USERNAME, AUTH_KEY, PASSWORD_RESET_TOKEN, EMAIL, VERIFICATION_TOKEN, US_NOME, US_APELIDO, US_CIDADE, US_TELEMOVEL, US_PONTOS, US_CONTRIBUINTE}, null, null, null, null, null);

        if (cursor.moveToFirst()) {

               useraux = new User(cursor.getInt(0), cursor.getString(1), cursor.getString(2), cursor.getString(3), cursor.getString(4), cursor.getString(5), cursor.getString(6), cursor.getString(7), cursor.getString(8), cursor.getInt(9), cursor.getInt(10), cursor.getInt(11));
            return useraux;
        }

        return null;

    }

}
