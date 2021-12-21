package com.example.gfastandroid.modelo;

//import com.android.volley.RequestQueue;


import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.gfastandroid.listeners.GuitarraListener;
import com.example.gfastandroid.listeners.GuitarrasListener;
import com.example.gfastandroid.utils.GFastJsonParser;

import org.json.JSONArray;

import java.util.ArrayList;

public class SingletonGestorGfast {

    private GfastBDHelper gfastBDHelper = null;
    private ArrayList<Guitarra> guitarras;
    private static SingletonGestorGfast instance = null;
    private static RequestQueue volleyQueue = null;
    private static final String urlAPIGFast = "http://192.168.1.225:8061/v1/guitarrasapis";
    private GuitarrasListener guitarrasListener;
    private GuitarraListener guitarraListener;


    public static synchronized SingletonGestorGfast getInstance(Context context) {
        if (instance == null)
            instance = new SingletonGestorGfast(context);
            volleyQueue = Volley.newRequestQueue(context);
        return instance;

    }

    public SingletonGestorGfast(Context context) {
        //gerarDadosDinamicos();
        guitarras = new ArrayList<>();
        gfastBDHelper = new GfastBDHelper(context);
    }

    public void setGuitarrasListener(GuitarrasListener guitarrasListener){

        this.guitarrasListener = guitarrasListener;

    }
    public void setGuitarraListener(GuitarraListener guitarraListener){

        this.guitarraListener = guitarraListener;

    }

    public ArrayList<Guitarra> getGuitarras()
    {
        guitarras = gfastBDHelper.getAllGuitarrasBD();
        return guitarras;
    }

    public Guitarra getGuitarraBD(int id) {

        for (Guitarra g: guitarras) {

            if(g.getGui_id() == id){

                return g;

            }

        }

        return null;
    }





    public void adicionarGuitarraBD(Guitarra guitarra){


        gfastBDHelper.adicionarGuitarraBD(guitarra);

    }

    public void adicionarGuitarrasBD(ArrayList<Guitarra> guitarras){

        gfastBDHelper.removerAllGuitarrasBD();
        for(Guitarra g : guitarras)
        {
            adicionarGuitarraBD(g);
        }

    }

    public void removerGuitarraBD(int id){

        Guitarra g = getGuitarraBD(id);

        if(g != null){
            gfastBDHelper.removerGuitarraBD(g.getGui_id());
        }

    }

    public void editarLivroBD(Guitarra guitarra){

        Guitarra g = getGuitarraBD(guitarra.getGui_id());
        if(g != null)
        {
            gfastBDHelper.editarGuitarraBD(g);

        }

    }

// ############################## API PEDIDOS ###############################################
    public void getAllGuitarrasAPI(final Context context){

     if(!GFastJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

            if(guitarrasListener != null ){
                guitarrasListener.onRefreshListaGuitarras(gfastBDHelper.getAllGuitarrasBD());
            }


        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, urlAPIGFast, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {


                    guitarras = GFastJsonParser.parserJsonGuitarras(response);
                    adicionarGuitarrasBD(guitarras);

                    if(guitarrasListener != null ){
                        guitarrasListener.onRefreshListaGuitarras(guitarras);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    // Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                    System.out.println(error.getMessage());
                }
            });

            volleyQueue.add(request);
        }

    }


}
