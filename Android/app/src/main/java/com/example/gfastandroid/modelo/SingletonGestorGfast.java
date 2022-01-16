package com.example.gfastandroid.modelo;

//import com.android.volley.RequestQueue;


import android.content.Context;
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

import org.eclipse.paho.android.service.MqttAndroidClient;
import org.eclipse.paho.client.mqttv3.IMqttActionListener;
import org.eclipse.paho.client.mqttv3.IMqttToken;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttConnectOptions;
import org.eclipse.paho.client.mqttv3.MqttException;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class SingletonGestorGfast {

    private MqttAndroidClient client = null;
    public GfastBDHelper gfastBDHelper = null;
    private ArrayList<Guitarra> guitarras;
    public User user;
    private static SingletonGestorGfast instance = null;
    private static RequestQueue volleyQueue = null;
    private static String urlAPIGFast;
    private static String urlAPILogin;
    private static String urlAPIGetLoggedUser;
    private static String urlAPIPutUser;
    public GuitarrasListener guitarrasListener;
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
        urlAPIGetLoggedUser = context.getString(R.string.iplocal) + "v1/user/checkuser";
        urlAPIPutUser = context.getString(R.string.iplocal) + "v1/users";

        try {

            if (!GFastJsonParser.isConnectionInternet(context)) {
                Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

                if (guitarrasListener != null) {
                    guitarrasListener.onRefreshListaGuitarras(gfastBDHelper.getAllGuitarrasBD());
                }


            } else {
                client = new MqttAndroidClient(context, "tcp://broker.emqx.io:1883", MqttClient.generateClientId());
                client.setCallback(new MosquittoCallBack(context));
                MqttConnectOptions mqttConnectOptions = new MqttConnectOptions();
                mqttConnectOptions.setCleanSession(true);
                // Establish a connection to IoT Platform by using MQTT.
                client.connect(mqttConnectOptions, null, new IMqttActionListener() {
                    @Override
                    public void onSuccess(IMqttToken asyncActionToken) {
                        try {
                            client.subscribe("INSERT", 1);
                            client.subscribe("UPDATE", 1);
                            client.subscribe("DELETE", 1);
                        } catch (MqttException e) {
                            e.printStackTrace();
                        }
                    }

                    @Override
                    public void onFailure(IMqttToken asyncActionToken, Throwable exception) {
                        System.out.println("-->erro:");
                    }
                });
            }
        } catch (MqttException e) {
            e.printStackTrace();
        }
    }

    public void setGuitarrasListener(GuitarrasListener guitarrasListener) {

        this.guitarrasListener = guitarrasListener;

    }

    public void setUserListener(UserListener userListener) {

        this.userListener = userListener;
    }

    public void setGuitarraListener(GuitarraListener guitarraListener) {

        this.guitarraListener = guitarraListener;

    }

    public ArrayList<Guitarra> getGuitarras() {
        guitarras = gfastBDHelper.getAllGuitarrasBD();
        return guitarras;
    }


    public Guitarra getGuitarraBD(int id) {


        for (Guitarra g : guitarras) {

            if (g.getGui_id() == id) {

                return g;

            }

        }

        return null;
    }

    public void adicionarGuitarraBD(Guitarra guitarra) {


        gfastBDHelper.adicionarGuitarraBD(guitarra);

    }

    public void adicionarGuitarrasBD(ArrayList<Guitarra> guitarras) {

        gfastBDHelper.removerAllGuitarrasBD();
        for (Guitarra g : guitarras) {
            adicionarGuitarraBD(g);
        }

    }

    public void adicionarLoggedUserBD(User user) {
        gfastBDHelper.removelAllUser();
        gfastBDHelper.adicionarUserBD(user);
        //gfastBDHelper.editarUserBD(user);
    }

    public void cleanDBUser() {
        gfastBDHelper.removelAllUser();
    }

    public User getUser() {

        User users = gfastBDHelper.getUser();
        return users;
    }

    public boolean getLoggedUser(String username, String token) {

        User users = gfastBDHelper.getUser();
        String bdtoken = users.getVerification_token();
        String bdusername = users.getUsername();

        return username.equals(bdusername) && token.equals(bdtoken);
    }


// ############################## API PEDIDOS ###############################################\\

    public void getAllGuitarrasAPI(final Context context) {

        if (!GFastJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

            if (guitarrasListener != null) {
                guitarrasListener.onRefreshListaGuitarras(gfastBDHelper.getAllGuitarrasBD());
            }


        } else {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, urlAPIGFast, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {


                    guitarras = GFastJsonParser.parserJsonGuitarras(response);
                    adicionarGuitarrasBD(guitarras);

                    if (guitarrasListener != null) {
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
        if (!GFastJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

            if (guitarrasListener != null) {
                guitarrasListener.onRefreshListaGuitarras(gfastBDHelper.getAllGuitarrasBD());
            }


        } else {
            StringRequest req = new StringRequest(Request.Method.POST, urlAPILogin, new Response.Listener<String>() {

                public void onResponse(String response) {

                    user = GFastJsonParser.parserJsonUser(response);
                    adicionarLoggedUserBD(user);

                    if (userListener != null) {
                        userListener.onValidateLogin(GFastJsonParser.parserJsonUser(response));


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


    public void editarUser(final User userlogged, final int iduser,  final Context context) {
        if (!GFastJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

        } else {
            StringRequest request = new StringRequest(Request.Method.PUT, urlAPIPutUser + "/" + iduser, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {

                    user = GFastJsonParser.parserJsonUser(response);
                    adicionarLoggedUserBD(user);

                    if (userListener != null) {
                        userListener.loginSharedPreferences(user);
                        Toast.makeText(context, "Editado com Sucesso", Toast.LENGTH_SHORT).show();
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {


                    try {
                        String body = new String(error.networkResponse.data, "UTF-8");
                        JSONArray obj = new JSONArray(body);
                        JSONObject errorMessage = obj.getJSONObject(0);
                        Toast.makeText(context, errorMessage.getString("message"), Toast.LENGTH_SHORT).show();

                    } catch (UnsupportedEncodingException | JSONException e) {
                        e.printStackTrace();
                    }

                }
            }) {
                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("username", userlogged.getUsername());
                    params.put("email", userlogged.getEmail());
                    params.put("us_nome", userlogged.getUs_nome());
                    params.put("us_apelido", userlogged.getUs_apelido());
                    params.put("us_contribuinte", userlogged.getUs_contribuinte() + "");
                    params.put("us_telemovel", userlogged.getUs_telemovel() + "");
                    params.put("us_email", userlogged.getEmail());
                    params.put("us_cidade", userlogged.getUs_cidade());
                    return params;

                }
            };
            volleyQueue.add(request);
        }
    }


}
