package com.example.gfastandroid.vistas;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.gfastandroid.MenuMainActivity;
import com.example.gfastandroid.R;
import com.example.gfastandroid.listeners.GuitarraListener;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;

public class DetalhesGuitarraActivity extends AppCompatActivity implements GuitarraListener {
    public static final String ID_GUITARRA = "gui_id";

    private Guitarra guitarra;

    private TextView tv_modelo, tv_subcategoria, tv_preco, tv_descricao, tv_marca;
    private ImageView imageGuitarra;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_guitarra);

        // calling the action bar
        ActionBar actionBar = getSupportActionBar();

        // showing the back button in action bar
        actionBar.setDisplayHomeAsUpEnabled(true);

        int id = getIntent().getIntExtra(ID_GUITARRA, 0);

        guitarra = SingletonGestorGfast.getInstance(getApplicationContext()).getGuitarraBD(id);

        tv_modelo = findViewById(R.id.tv_modelo);
        tv_subcategoria = findViewById(R.id.tv_subcategoria);
        tv_descricao = findViewById(R.id.tv_descricao);
        tv_preco = findViewById(R.id.tv_preco);
        tv_marca = findViewById(R.id.tv_marca);
        imageGuitarra = findViewById(R.id.imageGuitarra);

        //Ação de Editar
        if (guitarra != null) {

            carregarGuitarra();
        }

        Button button = (Button) findViewById(R.id.bt_adicionar);


        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                // click handling code
            }
        });


        SingletonGestorGfast.getInstance(getApplicationContext()).setGuitarraListener(this);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {

        MenuInflater menuInflater = getMenuInflater();
        menuInflater.inflate(R.menu.menu_fav_guitarra, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                this.finish();
                return true;
            case R.id.itemfav:
                adicionarGuitarra();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void adicionarGuitarra() {

        SharedPreferences sharedPreferencesUser = getSharedPreferences(MenuMainActivity.LOGIN, Context.MODE_PRIVATE);
        int iduser = sharedPreferencesUser.getInt("iduser", 0);
        SingletonGestorGfast.getInstance(getApplicationContext()).adicionarFavoritoApi(guitarra.getGui_id(), iduser, getApplicationContext());

    }


    private void carregarGuitarra() {

        setTitle(guitarra.getGui_nome());
        tv_modelo.setText(guitarra.getGui_nome());
        tv_subcategoria.setText(guitarra.getGui_idsubcategoria());

        tv_descricao.setText(guitarra.getGui_descricao());
        tv_preco.setText(guitarra.getGui_preco() + "€");

        Glide.with(getApplication())
                .load(getApplication().getString(R.string.iplocal) + guitarra.getGui_fotopath())
                .placeholder(R.drawable.logo_gfast)
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(imageGuitarra);

    }

    @Override
    public void onRefreshDetalhes(int op) {
        Intent intent = new Intent();
        intent.putExtra(MenuMainActivity.OP_CODE, op);
        setResult(RESULT_OK, intent);
        finish();
    }
}