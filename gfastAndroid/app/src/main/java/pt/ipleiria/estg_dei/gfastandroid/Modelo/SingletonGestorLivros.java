package pt.ipleiria.estg_dei.gfastandroid.Modelo;

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
import pt.ipleiria.estg_dei.gfastandroid.utils.LivrosJsonParser;

public class SingletonGestorLivros {

    private ArrayList<Livro> livros;
    private static SingletonGestorLivros instance = null;
    private static final String TOKEN = "AMSI-TOKEN";
    private static RequestQueue volleyQueue = null;
    private static final String urlAPILivros = "http://amsi.dei.estg.ipleiria.pt/api/livros";
    //172.22.205.81/v1/

    private LivroBDHelper livroBDHelper = null;

    private LivrosListener livrosListener;
    private LivroListener livroListener;

    public static synchronized SingletonGestorLivros getInstance(Context context){
        if(instance == null)
            instance = new SingletonGestorLivros(context);
            volleyQueue = Volley.newRequestQueue(context);

        return instance;
    }

    public SingletonGestorLivros(Context context) {


        livros = new ArrayList<>();
        livroBDHelper = new LivroBDHelper(context);
    }

    public void setLivrosListener(LivrosListener LivrosListener){

        this.livrosListener = LivrosListener;

    }
    public void setLivroListener(LivroListener LivroListener){

        this.livroListener = livroListener;

    }

    public ArrayList<Livro> getLivros()
    {
        livros = livroBDHelper.getAllLivrosBD();
        return livros;
    }

    public Livro getLivroBD(int id) {

        for (Livro l: livros) {

            if(l.getId() == id){

                return l;

            }

        }

        return null;
    }

    public void adicionarLivroBD(Livro livro){


        livroBDHelper.adicionarLivroBD(livro);

    }

    public void adicionarLivrosBD(ArrayList<Livro> livros){

        livroBDHelper.removerAllLivroBD();
        for(Livro l : livros)
        {
            adicionarLivroBD(l);
        }

    }

    public void removerLivroBD(int id){

       Livro l = getLivroBD(id);
        if(l != null){
          livroBDHelper.removerLivroBD(l.getId());
        }

    }

    public void editarLivroBD(Livro livro){

        Livro l = getLivroBD(livro.getId());
        if(l!= null)
        {
            livroBDHelper.editarLivroBD(l);

        }

    }

/*#################################################MÉTODOS API######################################################################*/


    public void getAllLivrosAPI(final Context context){

        if(!LivrosJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

           if(livrosListener != null ){
               livrosListener.onRefreshListaLivros(livroBDHelper.getAllLivrosBD());
           }


        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, urlAPILivros, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {


                    livros = LivrosJsonParser.parserJsonLivros(response);
                    adicionarLivrosBD(livros);

                    if(livrosListener != null ){
                        livrosListener.onRefreshListaLivros(livros);
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
    public void adicionarLivroAPI(final Livro livro, final Context context){
        if(!LivrosJsonParser.isConnectionInternet(context))
        {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();
        }
        else{
            StringRequest request = new StringRequest(Request.Method.POST, urlAPILivros, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    /*adicionarLivroBD(LivrosJsonParser.parserJsonLivro(response));

                    if(livroListener != null ){
                        livroListener.onRefreshDetalhes(MenuMainActivity.ADD);
                    }*/
                    System.out.println("----- aqui: " + response);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }){
                @Override
                protected Map<String, String> getParams(){
                    Map<String, String> params = new HashMap<>();
                    params.put("token", TOKEN);
                    params.put("titulo", livro.getTitulo());
                    params.put("serie", livro.getSerie());
                    params.put("autor", livro.getAutor());
                    params.put("ano", livro.getAno()+ "");
                    params.put("capa", livro.getCapa());
                     return params;

                }
            };
            volleyQueue.add(request);
        }
    }

    public void editarLivroAPI(final Livro livro, final Context context) {
        if(!LivrosJsonParser.isConnectionInternet(context))
        {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

        }
        else{
            StringRequest request = new StringRequest(Request.Method.PUT, urlAPILivros + "/" + livro.getId(), new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    editarLivroBD(livro);
                    if(livroListener != null ){
                        livroListener.onRefreshDetalhes(MenuMainActivity.EDIT);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

                }
            }){
                @Override
                protected Map<String, String> getParams(){
                    Map<String, String> params = new HashMap<>();
                    params.put("token", TOKEN);
                    params.put("titulo", livro.getTitulo());
                    params.put("serie", livro.getSerie());
                    params.put("autor", livro.getAutor());
                    params.put("ano", livro.getAno()+ "");
                    params.put("capa", livro.getCapa());
                    return params;

                }
            };
            volleyQueue.add(request);
        }
    }
    public void removerLivroAPI(final Livro livro, final Context context){
        if(!LivrosJsonParser.isConnectionInternet(context))
        {
            Toast.makeText(context, "Não tem ligação à rede", Toast.LENGTH_SHORT).show();

        }else
        {
            StringRequest request = new StringRequest(Request.Method.DELETE, urlAPILivros + "/" + livro.getId(), new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    removerLivroBD(livro.getId());
                    if(livroListener != null ){
                        livroListener.onRefreshDetalhes(MenuMainActivity.DELETE);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();

                }
            });
            volleyQueue.add(request);
        }
    }
}
