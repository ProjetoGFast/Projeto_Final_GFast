package com.example.gfastandroid.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.gfastandroid.modelo.Guitarra;

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
                int gui_idsubcategoria = guitarra.getInt("gui_idsubcategoria");
                int gui_idmarca = guitarra.getInt("gui_idmarca");
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


    public static boolean isConnectionInternet(Context context){

        ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connectivityManager.getActiveNetworkInfo();

        System.out.println(networkInfo);
        return networkInfo != null && networkInfo.isConnected();

    }

}
