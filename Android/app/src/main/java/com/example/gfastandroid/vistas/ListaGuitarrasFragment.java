package com.example.gfastandroid.vistas;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gfastandroid.MenuMainActivity;
import com.example.gfastandroid.R;
import com.example.gfastandroid.adaptadores.ListaGuitarraAdaptador;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import java.util.ArrayList;


public class ListaGuitarrasFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener{


    private FragmentManager fragmentManager;
    private ListView lvGuitarras;
    private ArrayList<Guitarra> guitarras;
    private TextView tvModelo, tvMarca, tvPreco;
    private FloatingActionButton fabAdicionar;
    private SearchView searchView;
    private ActivityResultLauncher<Intent> activityResultLauncher;
    private SwipeRefreshLayout swipeRefreshLayout;

    public ListaGuitarrasFragment() {
        // Required empty public constructor
    }






    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        setHasOptionsMenu(true);
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_guitarras, container, false);

        lvGuitarras = view.findViewById(R.id.lvguitarras);

        guitarras = SingletonGestorGfast.getInstance().getGuitarras();


        lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), guitarras));


        lvGuitarras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long id) {


                //Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
               // intent.putExtra(DetalhesLivroActivity.ID_LIVRO, (int) id);


                //activityResultLauncher.launch(intent);
            }
        });

        fabAdicionar = view.findViewById(R.id.fabListaGuitarras);
        fabAdicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
              //  Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
             //   activityResultLauncher.launch(intent);
            }
        });

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);


        return view;


    }




    public void carregarGuitarras(){

        ArrayList<Guitarra> guitarras = SingletonGestorGfast.getInstance().getGuitarras();

        if(guitarras.size() > 0){

            Guitarra guitarra = guitarras.get(0);
            tvModelo.setText(guitarra.getGui_nome());
            tvMarca.setText("" + guitarra.getGui_idmarca());
            tvPreco.setText("" + guitarra.getGui_preco());

        }
    }


    @Override
    public void onRefresh() {

        guitarras = SingletonGestorGfast.getInstance().getGuitarras();
        lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), guitarras));

        swipeRefreshLayout.setRefreshing(false);
    }
}