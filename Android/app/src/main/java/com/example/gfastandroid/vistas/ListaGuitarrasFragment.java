package com.example.gfastandroid.vistas;

import android.content.Intent;
import android.os.Bundle;

import androidx.activity.result.ActivityResultLauncher;
import androidx.annotation.NonNull;
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

import com.example.gfastandroid.R;
import com.example.gfastandroid.adaptadores.ListaGuitarraAdaptador;
import com.example.gfastandroid.listeners.GuitarrasListener;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

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

        try {
            // Inflate the layout for this fragment
            View view = inflater.inflate(R.layout.fragment_lista_guitarras, container, false);

            lvGuitarras = view.findViewById(R.id.lvguitarras);
            lvGuitarras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                @Override
                public void onItemClick(AdapterView<?> adapterView, View view, int i, long id) {

                    //Abrir ativade de detalhes da guitarra
                    Intent intent = new Intent(getContext(), DetalhesGuitarraActivity.class);
                    intent.putExtra(DetalhesGuitarraActivity.ID_GUITARRA, (int) id);
                    startActivity(intent);


                }
            });


            swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
            swipeRefreshLayout.setOnRefreshListener(this);

            //Listener da guitara à escuta
            SingletonGestorGfast.getInstance(getContext()).setGuitarrasListener(this);
            //Obter Todas as guitarras
            SingletonGestorGfast.getInstance(getContext()).getAllGuitarrasAPI(getContext());

            return view;
        } catch (Exception e) {
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public void onCreateOptionsMenu(@NonNull Menu menu, @NonNull MenuInflater inflater) {
        try {
            //Procurar Guitarras
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

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onRefresh() {
        try {
            SingletonGestorGfast.getInstance(getContext()).getAllGuitarrasAPI(getContext());

            swipeRefreshLayout.setRefreshing(false);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onRefreshGuitarras() {
        try {
            ArrayList<Guitarra> arrayListGuitarras = SingletonGestorGfast.getInstance(getContext()).gfastBDHelper.getAllGuitarrasBD();
            lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), arrayListGuitarras));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onRefreshListaGuitarras(ArrayList<Guitarra> guitarras) {
        try {
            if (guitarras != null) {
                lvGuitarras.setAdapter(new ListaGuitarraAdaptador(getContext(), guitarras));
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}