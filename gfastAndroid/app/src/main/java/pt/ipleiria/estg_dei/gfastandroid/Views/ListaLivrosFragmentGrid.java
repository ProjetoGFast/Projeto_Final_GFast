package pt.ipleiria.estg_dei.gfastandroid.Views;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import pt.ipleiria.estg_dei.gfastandroid.R;


public class ListaLivrosFragmentGrid extends Fragment {


    public ListaLivrosFragmentGrid() {

    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_lista_livros_grid, container, false);
    }
}