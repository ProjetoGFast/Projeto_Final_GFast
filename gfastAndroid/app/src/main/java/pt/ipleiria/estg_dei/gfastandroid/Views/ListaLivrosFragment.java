package pt.ipleiria.estg_dei.gfastandroid.Views;

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

import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import java.util.ArrayList;

import pt.ipleiria.estg_dei.gfastandroid.Listeners.LivrosListener;
import pt.ipleiria.estg_dei.gfastandroid.MenuMainActivity;
import pt.ipleiria.estg_dei.gfastandroid.Modelo.Livro;
import pt.ipleiria.estg_dei.gfastandroid.Modelo.SingletonGestorLivros;
import pt.ipleiria.estg_dei.gfastandroid.R;
import pt.ipleiria.estg_dei.gfastandroid.adaptadores.ListaLivroAdaptador;


public class ListaLivrosFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, LivrosListener {


    private ListView lvlivros;
    private ArrayList<Livro> livros;
    private FloatingActionButton fabAdicionar;
    private SearchView searchView;
    private ActivityResultLauncher<Intent> activityResultLauncher;
    private SwipeRefreshLayout swipeRefreshLayout;


    public ListaLivrosFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        activityResultLauncher = registerForActivityResult(new ActivityResultContracts.StartActivityForResult(), new ActivityResultCallback<ActivityResult>() {
            @Override
            public void onActivityResult(ActivityResult result) {
                if (result.getResultCode() == Activity.RESULT_OK) {
                    switch (result.getData().getIntExtra(MenuMainActivity.OP_CODE, 0)) {
                        case MenuMainActivity.ADD_REQCOD:
                            Snackbar.make(getView(), "Livro Adicionado com sucesso", Snackbar.LENGTH_SHORT).show();
                            break;
                        case MenuMainActivity.EDIT_REQCOD:
                            Snackbar.make(getView(), "Livro Modificado com sucesso", Snackbar.LENGTH_SHORT).show();
                            break;
                        case MenuMainActivity.DEL_REQCOD:
                            Snackbar.make(getView(), "Livro Removido com sucesso", Snackbar.LENGTH_SHORT).show();
                            break;
                    }
                }
            }
        });
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        setHasOptionsMenu(true);
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_lista_livros, container, false);

        lvlivros = view.findViewById(R.id.lvlivros);


        lvlivros.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long id) {
                System.out.println("----"+ id);
                Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
                intent.putExtra(DetalhesLivroActivity.ID_LIVRO, (int) id);

                activityResultLauncher.launch(intent);
            }
        });

        fabAdicionar = view.findViewById(R.id.fabLista);
        fabAdicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getContext(), DetalhesLivroActivity.class);
                activityResultLauncher.launch(intent);
            }
        });

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);


        SingletonGestorLivros.getInstance(getContext()).setLivrosListener(this);
        SingletonGestorLivros.getInstance(getContext()).getAllLivrosAPI(getContext());

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

                ArrayList<Livro> tempLivros = new ArrayList<>();

                for (Livro l : SingletonGestorLivros.getInstance(getContext()).getLivros()) {
                    if (l.getTitulo().toLowerCase().contains(s.toLowerCase())) {
                        tempLivros.add(l);
                    }

                }

                lvlivros.setAdapter(new ListaLivroAdaptador(getContext(), tempLivros));
                return true;
            }
        });

        super.onCreateOptionsMenu(menu, inflater);
    }

    @Override
    public void onRefresh() {
        SingletonGestorLivros.getInstance(getContext()).getAllLivrosAPI(getContext());

        swipeRefreshLayout.setRefreshing(false);
    }


    @Override
    public void onRefreshListaLivros(ArrayList<Livro> livros) {
        if(livros != null)
        {
            lvlivros.setAdapter(new ListaLivroAdaptador(getContext(), livros));
        }
    }
}