package com.example.gfastandroid.vistas;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
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
import com.example.gfastandroid.listeners.GuitarrasListener;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import java.util.ArrayList;


public class ListaGuitarrasFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, GuitarrasListener {

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
        lvGuitarras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long id) {


                Intent intent = new Intent(getContext(), DetalhesGuitarraActivity.class);
                intent.putExtra(DetalhesGuitarraActivity.ID_GUITARRA, (int) id);

                activityResultLauncher.launch(intent);
            }
        });

        fabAdicionar = view.findViewById(R.id.fabListaGuitarras);
        fabAdicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               // Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
               // activityResultLauncher.launch(intent);
            }
        });

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);

        SingletonGestorGfast.getInstance(getContext()).setGuitarrasListener(this);
        SingletonGestorGfast.getInstance(getContext()).getAllGuitarrasAPI(getContext());

        return view;


    }

    @Override
    public void onCreateOptionsMenu(@NonNull Menu menu, @NonNull MenuInflater inflater) {
        inflater.inflate(R.menu.menu_pesquisa, menu);
        MenuItem itemPesquisa = menu.findItem(R.id.itemPesquisa);
        searchView = (SearchView) itemPesquisa.getActionView();

        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String s) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String s) {

                ArrayList<Guitarra> guitarrasbd = new ArrayList<>();

                for (Guitarra g : SingletonGestorGfast.getInstance(getContext()).getGuitarras()) {
                    if (g.getGui_nome().toLowerCase().contains(s.toLowerCase())) {
                        guitarrasbd.add(g);
                    }

                }

                lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), guitarrasbd));
                return true;
            }
        });

        super.onCreateOptionsMenu(menu, inflater);
    }

    @Override
    public void onRefresh() {
        SingletonGestorGfast.getInstance(getContext()).getAllGuitarrasAPI(getContext());

        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshGuitarras() {

        ArrayList<Guitarra>arrayListGuitarras=SingletonGestorGfast.getInstance(getContext()).gfastBDHelper.getAllGuitarrasBD();
        lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), arrayListGuitarras));

    }

    @Override
    public void onRefreshListaGuitarras(ArrayList<Guitarra> guitarras) {
        if(guitarras != null)
        {
            lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), guitarras));
        }
    }
}