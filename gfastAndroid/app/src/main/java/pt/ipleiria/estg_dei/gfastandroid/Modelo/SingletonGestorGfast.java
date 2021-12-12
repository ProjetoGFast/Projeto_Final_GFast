package pt.ipleiria.estg_dei.gfastandroid.Modelo;

import com.android.volley.RequestQueue;

import java.util.ArrayList;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import pt.ipleiria.estg_dei.gfastandroid.Listeners.LivroListener;
import pt.ipleiria.estg_dei.gfastandroid.Listeners.LivrosListener;
import pt.ipleiria.estg_dei.gfastandroid.MenuMainActivity;
import pt.ipleiria.estg_dei.gfastandroid.R;
import pt.ipleiria.estg_dei.gfastandroid.utils.LivrosJsonParser;

public class SingletonGestorGfast {

    private ArrayList<Guitarras> guitarras;
    private static SingletonGestorGfast instance = null;
    private static final String TOKEN = "AMSI-TOKEN";
    private static RequestQueue volleyQueue = null;
    private static final String urlAPILivros = "http://gfastbackend:8061/v1/guitarrasapi";



}
