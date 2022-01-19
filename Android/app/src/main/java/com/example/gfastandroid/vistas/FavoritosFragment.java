package com.example.gfastandroid.vistas;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.activity.result.ActivityResultLauncher;
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

import com.example.gfastandroid.MenuMainActivity;
import com.example.gfastandroid.R;
import com.example.gfastandroid.adaptadores.ListaGuitarraAdaptador;
import com.example.gfastandroid.listeners.FavoritosListener;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;


public class FavoritosFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, FavoritosListener {

    private FragmentManager fragmentManager;
    private ListView lvGuitarras;
    private ArrayList<Guitarra> guitarras;
    private TextView tvModelo, tvMarca, tvPreco;
    private FloatingActionButton fabAdicionar;
    private SearchView searchView;
    private ActivityResultLauncher<Intent> activityResultLauncher;
    private SwipeRefreshLayout swipeRefreshLayout;
    public FavoritosFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        setHasOptionsMenu(true);
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_favoritos, container, false);

       lvGuitarras = view.findViewById(R.id.lvguitarrasfav);
        lvGuitarras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long id) {


                Intent intent = new Intent(getContext(), DetalhesGuitarraActivity.class);
                intent.putExtra(DetalhesGuitarraActivity.ID_GUITARRA, (int) id);
                startActivity(intent);


            }
        });

        fabAdicionar = view.findViewById(R.id.fabListafav);
        fabAdicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                // Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
                // activityResultLauncher.launch(intent);
            }
        });

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layoutfav);
        swipeRefreshLayout.setOnRefreshListener(this);

        SharedPreferences sharedPreferencesUser = getActivity().getSharedPreferences(MenuMainActivity.LOGIN, Context.MODE_PRIVATE);
        int iduser = sharedPreferencesUser.getInt("iduser", 0);

        SingletonGestorGfast.getInstance(getContext()).setFavoritosListener(this);
        SingletonGestorGfast.getInstance(getContext()).getFavoritosByUser( iduser, getContext());

        return view;

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

    @Override
    public void onRefresh() {

        SingletonGestorGfast.getInstance(getContext()).getAllGuitarrasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }
}