package pt.ipleiria.estg_dei.gfastandroid.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.ipleiria.estg_dei.gfastandroid.Modelo.Livro;

public class LivrosJsonParser {


    public static ArrayList<Livro> parserJsonLivros(JSONArray response) {
        ArrayList<Livro> livros = new ArrayList<>();
        try {

            for(int i = 0; i<response.length(); i++)
            {
                JSONObject livro = (JSONObject) response.get(i);
                int idlivro = livro.getInt("id");
                String titulo = livro.getString("titulo");
                String serie = livro.getString("serie");
                String autor = livro.getString("autor");
                int ano = livro.getInt("ano");
                String capa = livro.getString("capa");

                Livro auxLivro = new Livro(idlivro, ano, capa, titulo, serie, autor);
                livros.add(auxLivro);
            }

        } catch (JSONException e) {
            e.printStackTrace();

        }
        return livros;
    }

    public static Livro parserJsonLivro(String response) {
        Livro auxLivro = null;
        try {

           JSONObject livro = new JSONObject(response);
            int idlivro = livro.getInt("id");
            String titulo = livro.getString("titulo");
            String serie = livro.getString("serie");
            String autor = livro.getString("autor");
            int ano = livro.getInt("ano");
            String capa = livro.getString("capa");

            auxLivro = new Livro(idlivro, ano, capa, titulo, serie, autor);


        } catch (JSONException e) {
            e.printStackTrace();

        }
        return auxLivro;
    }

    public static boolean isConnectionInternet(Context context){

        ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connectivityManager.getActiveNetworkInfo();

        System.out.println(networkInfo);
        return networkInfo != null && networkInfo.isConnected();

    }
}
