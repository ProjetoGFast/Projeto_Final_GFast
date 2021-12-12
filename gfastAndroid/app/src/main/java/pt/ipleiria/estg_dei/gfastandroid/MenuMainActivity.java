package pt.ipleiria.estg_dei.gfastandroid;

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

import com.google.android.material.navigation.NavigationView;

import pt.ipleiria.estg_dei.gfastandroid.Views.ListaLivrosFragment;


public class MenuMainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    public static final String EMAIL = "email";
    public static final String OP_CODE = "operacao";
    public static final int ADD_REQCOD = 1, EDIT_REQCOD = 2, DEL_REQCOD = 3;
    public static final int ADD = 100, EDIT = 200, DELETE = 300;
    private NavigationView navigationView;
    private DrawerLayout drawer;
    private String email;
    private FragmentManager fragmentManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);
        Toolbar toolbar = findViewById(R.id.toolbar);

        setSupportActionBar(toolbar);
        drawer = findViewById(R.id.drawerLayout);
        navigationView = findViewById(R.id.navView);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer,
                toolbar, R.string.ndOpen, R.string.ndClose);
        toggle.syncState();
        drawer.addDrawerListener(toggle);

        navigationView.setNavigationItemSelectedListener(this);
        carregarCabecalho();

        fragmentManager = getSupportFragmentManager();
        carregarFragmentoInicial();
    }

    private void carregarCabecalho() {
        email = getIntent().getStringExtra(EMAIL);

        SharedPreferences sharedPreferences = getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE);

        if (email != null) {

            SharedPreferences.Editor editor = sharedPreferences.edit();
            editor.putString(EMAIL, email);
            editor.apply();

        } else {
            email = sharedPreferences.getString(EMAIL, "Email não existe");
        }

        View view = navigationView.getHeaderView(0);
        TextView tvEmail = view.findViewById(R.id.tvEmailHeader);
        tvEmail.setText(email);

    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {

        Fragment fragment = null;


        switch (item.getItemId()) {
            case R.id.navEstatico:
                fragment = new ListaLivrosFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navDinamico:
                // fragment = new DinamicoFragment();
                setTitle(item.getTitle());
                break;
            case R.id.navEmail:
                enviarEmail();
                break;
        }
        if (fragment != null)
            fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();


        drawer.closeDrawer(GravityCompat.START);
        return false;
    }

    public void enviarEmail() {
        String subject = "AMSI 2021/2022";
        String message = "olá " + email + " isto é uma mensagem de texto enviada pela minha APP! :)";

        Intent intent = new Intent(Intent.ACTION_SEND);
        intent.setType("message/rfc822");
        intent.putExtra(Intent.EXTRA_EMAIL, new String[]{email});
        intent.putExtra(Intent.EXTRA_SUBJECT, subject);
        intent.putExtra(Intent.EXTRA_TEXT, message);

        if (intent.resolveActivity(getPackageManager()) != null) {
            startActivity(intent);
        }
    }

    private boolean carregarFragmentoInicial() {
        Menu menu = navigationView.getMenu();
        MenuItem item = menu.getItem(0);
        item.setCheckable(true);
        return onNavigationItemSelected(item);

    }
}