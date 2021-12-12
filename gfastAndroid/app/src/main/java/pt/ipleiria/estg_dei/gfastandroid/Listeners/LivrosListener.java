package pt.ipleiria.estg_dei.gfastandroid.Listeners;

import java.util.ArrayList;

import pt.ipleiria.estg_dei.gfastandroid.Modelo.Livro;


public interface LivrosListener {
    void onRefreshListaLivros(ArrayList<Livro>  livros);
}
