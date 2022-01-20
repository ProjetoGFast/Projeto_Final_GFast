package com.example.gfastandroid.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.gfastandroid.modelo.Favoritos;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.User;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class GFastJsonParser {


    public static ArrayList<Guitarra> parserJsonGuitarras(JSONArray response) {
        ArrayList<Guitarra> guitarras = new ArrayList<>();
        try {

            for(int i = 0; i<response.length(); i++)
            {
                JSONObject guitarra = (JSONObject) response.get(i);
                int gui_id = guitarra.getInt("gui_id");
                String gui_nome = guitarra.getString("gui_nome");
                String gui_idsubcategoria = guitarra.getString("gui_idsubcategoria");
                String gui_idmarca = guitarra.getString("gui_idmarca");
                String gui_idreferencia = guitarra.getString("gui_idreferencia");
                String gui_descricao = guitarra.getString("gui_descricao");
                int gui_preco = guitarra.getInt("gui_preco");
                int gui_iva = guitarra.getInt("gui_iva");
                String gui_fotopath = guitarra.getString("gui_fotopath");
                String gui_qrcodepath = guitarra.getString("gui_qrcodepath");
                int gui_inativo = guitarra.getInt("gui_inativo");

               Guitarra auxGuitarra = new Guitarra( gui_id, gui_idsubcategoria, gui_idmarca, gui_iva, gui_preco, gui_nome, gui_idreferencia, gui_descricao, gui_fotopath, gui_qrcodepath, gui_inativo);
                guitarras.add(auxGuitarra);
            }

        } catch (JSONException e) {
            e.printStackTrace();

        }
        return guitarras;
    }


    public static ArrayList<Favoritos> parserJsonFavoritos(JSONArray response) {
        ArrayList<Favoritos> favoritos = new ArrayList<>();
        try {

            for(int i = 0; i<response.length(); i++)
            {
                JSONObject favorito = (JSONObject) response.get(i);
                int fav_id = favorito.getInt("fav_id");
                int fav_idguitarras = favorito.getInt("fav_idguitarras");
                int fav_iduser = favorito.getInt("fav_iduser");


                Favoritos auxFavoritos = new Favoritos(fav_id, fav_idguitarras, fav_iduser);
                favoritos.add(auxFavoritos);
            }

        } catch (JSONException e) {
            e.printStackTrace();

        }
        return favoritos;
    }


    public static Favoritos parserJsonFavorito(String response) {

        Favoritos auxFav = null;
        try {

            JSONObject favorito = new JSONObject(response);
            int fav_id = favorito.getInt("fav_id");
            int fav_idguitarras = favorito.getInt("fav_idguitarras");
            int fav_iduser = favorito.getInt("fav_iduser");


            auxFav = new Favoritos(fav_id, fav_idguitarras, fav_iduser);


        } catch (JSONException e) {
            e.printStackTrace();

        }
        return auxFav;
    }



    public static boolean isConnectionInternet(Context context){

        ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connectivityManager.getActiveNetworkInfo();

        System.out.println(networkInfo);
        return networkInfo != null && networkInfo.isConnected();

    }


    public static String parserJsonLogin(String response) {
        String token = null;
        try {
            JSONObject login = new JSONObject(response);
            token = login.getString("verification_token");
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return token;
    }

    public static User parserJsonUser(String response) {
        User auxUser = null;
        try {

            JSONObject user = new JSONObject(response);
            int idUser = user.getInt("id");
            String username = user.getString("username");
            String auth_key = user.getString("auth_key");
            String password_reset_token = user.getString("password_reset_token");
            String email = user.getString("email");
            String verification_token = user.getString("verification_token");
            String us_nome = user.getString("us_nome");
            String us_apelido = user.getString("us_apelido");
            String us_cidade = user.getString("us_cidade");
            int us_telemovel = user.getInt("us_telemovel");
            int us_contribuinte = user.getInt("us_contribuinte");
            int us_pontos = user.getInt("us_pontos");

            auxUser = new User(idUser, username,auth_key,password_reset_token,email, verification_token, us_nome, us_apelido, us_cidade, us_telemovel, us_contribuinte, us_pontos);


        } catch (JSONException e) {
            e.printStackTrace();

        }
        return auxUser;
    }

}
