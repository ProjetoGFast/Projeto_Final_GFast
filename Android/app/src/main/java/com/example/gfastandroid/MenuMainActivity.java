package com.example.gfastandroid;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.example.gfastandroid.adaptadores.ListaFavoritosAdaptador;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.example.gfastandroid.vistas.CarrinhoFragment;
import com.example.gfastandroid.vistas.FavoritosFragment;
import com.example.gfastandroid.vistas.ListaGuitarrasFragment;
import com.example.gfastandroid.vistas.LocalizacaoFragment;
import com.example.gfastandroid.vistas.NoticiasFragment;
import com.example.gfastandroid.vistas.PerfilFragment;
import com.example.gfastandroid.vistas.SobreFragment;
import com.google.android.material.navigation.NavigationView;


public class MenuMainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    public static final String USERNAME = "username";
    public static final String TOKEN = "token";
    public static final String LOGIN = "Login";
    private NavigationView navigationView;
    private DrawerLayout drawer;
    private String username;
    private FragmentManager fragmentManager;
    public static final String OP_CODE = "operacao";
    public static final String FAVORITOSTAB = "favtab";
    public static final int ADD_REQCOD = 1, EDIT_REQCOD = 2, DEL_REQCOD = 3;
    public static final int ADD = 100, EDIT = 200, DELETE = 300;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            setContentView(R.layout.activity_menu_main);
            Toolbar toolbar = findViewById(R.id.toolbar);

            setSupportActionBar(toolbar);
            drawer = findViewById(R.id.drawerLayout);
            navigationView = findViewById(R.id.navView);

            ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.ndOpen, R.string.ndClose);
            toggle.syncState();
            drawer.addDrawerListener(toggle);
            navigationView.setNavigationItemSelectedListener(this);

            //Carrega o Cabecalho
            carregarCabecalho();
            fragmentManager = getSupportFragmentManager();
            //Get string Extra
            String favtab = getIntent().getStringExtra(FAVORITOSTAB);

            if (favtab != null) {

                if (favtab.equals("true")) {
                    //Abre fragemento dos favoritos
                    carregarFragmentoFavoritos();
                }

            } else {
                //Abre fragmento das guitarras
                carregarFragmentoGuitarras();

            }

            //Obter id de utilizador das sharedpreferences
            SharedPreferences sharedPreferencesUser = getApplication().getSharedPreferences(MenuMainActivity.LOGIN, Context.MODE_PRIVATE);
            int iduser = sharedPreferencesUser.getInt("iduser", 0);
            //Obter todas as guitarras nos favoritos do user
            SingletonGestorGfast.getInstance(getApplicationContext()).getFavoritosByUser(iduser, getApplicationContext());
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    private void carregarCabecalho() {

        SharedPreferences sharedpreferences = this.getSharedPreferences("Login", 0);

        String username = sharedpreferences.getString("username", null);

        if (username != null) {
            View view = navigationView.getHeaderView(0);
            TextView tvUsername = view.findViewById(R.id.tvUsernameDrawer);
            tvUsername.setText(username);
        }

    }

    private void logout() {

        //Eliminar user da bd
        SingletonGestorGfast.getInstance(getApplicationContext()).cleanDBUser();
        SharedPreferences sharedpreferences = this.getSharedPreferences("Login", 0);
        //Limpar SharedPreferences
        SharedPreferences.Editor editor = sharedpreferences.edit();
        editor.clear();
        editor.apply();
        finish();
        //Abrir atividade de Login
        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
        startActivity(intent);
        finish();
    }


    private boolean carregarFragmentoGuitarras() {

        //Obter fragmento das guitarras
        Menu menu = navigationView.getMenu();
        MenuItem item = menu.getItem(1);
        item.setCheckable(true);
        return onNavigationItemSelected(item);

    }

    private boolean carregarFragmentoFavoritos() {
        //Abrir fragmento dos favoritos
        Menu menu = navigationView.getMenu();
        MenuItem item = menu.getItem(3);
        item.setCheckable(true);
        return onNavigationItemSelected(item);

    }


    public void onClickDetalhesEmail() {

        //Abrir a aplicação de email do telemovel
        String subject = "AMSI 2021/2022";
        String message = "olá " + username + " isto é uma mensagem de texto enviada pela minha APP! :)";

        Intent intent = new Intent(Intent.ACTION_SEND);
        intent.setType("message/rfc822");
        intent.putExtra(Intent.EXTRA_EMAIL, new String[]{username});
        intent.putExtra(Intent.EXTRA_SUBJECT, subject);
        intent.putExtra(Intent.EXTRA_TEXT, message);

        if (intent.resolveActivity(getPackageManager()) != null) {
            startActivity(intent);
        }
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {

        Fragment fragment = null;
        //Switch da Drawer
        switch (item.getItemId()) {
            case R.id.navPerfil:
                fragment = new PerfilFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navGuitarras:
                fragment = new ListaGuitarrasFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navFavoritos:
                fragment = new FavoritosFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navCarrinho:
                fragment = new CarrinhoFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navNoticias:
                fragment = new NoticiasFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navSobre:
                fragment = new SobreFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navEmail:
                onClickDetalhesEmail();
                break;

            case R.id.navSair:
                logout();
                break;
        }
        if (fragment != null)
            fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();

        drawer.closeDrawer(GravityCompat.START);
        return false;
    }
}