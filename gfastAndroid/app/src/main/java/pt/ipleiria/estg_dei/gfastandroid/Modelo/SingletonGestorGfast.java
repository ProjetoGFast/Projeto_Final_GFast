package pt.ipleiria.estg_dei.gfastandroid.Modelo;

import java.util.ArrayList;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class SingletonGestorGfast {

    private ArrayList<Guitarra> guitarras;
    private static SingletonGestorGfast instance = null;
    private static final String TOKEN = "AMSI-TOKEN";
    private static RequestQueue volleyQueue = null;
    private static final String urlAPILivros = "http://gfastbackend:8061/v1/guitarrasapi";



}
