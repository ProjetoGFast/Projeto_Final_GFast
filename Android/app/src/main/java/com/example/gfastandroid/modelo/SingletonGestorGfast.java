package com.example.gfastandroid.modelo;

//import com.android.volley.RequestQueue;


import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.gfastandroid.R;
import com.example.gfastandroid.listeners.GuitarraListener;
import com.example.gfastandroid.listeners.GuitarrasListener;
import com.example.gfastandroid.listeners.UserListener;
import com.example.gfastandroid.utils.GFastJsonParser;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class SingletonGestorGfast {

    private GfastBDHelper gfastBDHelper = null;
    private ArrayList<Guitarra> guitarras;
    private static SingletonGestorGfast instance = null;
    private static RequestQueue volleyQueue = null;
    private static String urlAPIGFast;
    private static String urlAPILogin;
    private static String urlAPIUser;
    private GuitarrasListener guitarrasListener;
    private GuitarraListener guitarraListener;
    public UserListener userListener;

    public static synchronized SingletonGestorGfast getInstance(Context context) {
        if (instance == null)
            instance = new SingletonGestorGfast(context);
            volleyQueue = Volley.newRequestQueue(context);
        return instance;

    }

    public SingletonGestorGfast(Context context) {

        guitarras = new ArrayList<>();
        gfastBDHelper = new GfastBDHelper(context);
        urlAPIGFast = context.getString(R.string.iplocal) + "v1/guitarrasapis";
        urlAPILogin = context.getString(R.string.iplocal) + "v1/user/login";
        urlAPIUser = context.getString(R.string.iplocal) + "v1/user/checkuser";
    }

    public void setGuitarrasListener(GuitarrasListener guitarrasListener){

        this.guitarrasListener = guitarrasListener;

    }

    public void setUserListener(UserListener userListener) {

        this.userListener = userListener;
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





// ############################## API PEDIDOS ###############################################\\

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

    public void loginUserAPI(final String username, final String password, final Context context) {
        StringRequest req = new StringRequest(Request.Method.POST, urlAPILogin, new Response.Listener<String>() {

            public void onResponse(String response) {
                if (userListener != null) {
                    userListener.onValidateLogin(GFastJsonParser.parserJsonLogin(response), username);
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                if (userListener != null) {
                    userListener.onErroLogin();


                }
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("username", username);
                params.put("password", password);
                return params;
            }
        };

        volleyQueue.add(req);
    }


}
