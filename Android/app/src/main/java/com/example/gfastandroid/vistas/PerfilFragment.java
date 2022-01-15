package com.example.gfastandroid.vistas;


import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.method.SingleLineTransformationMethod;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import com.example.gfastandroid.LoginActivity;
import com.example.gfastandroid.MenuMainActivity;
import com.example.gfastandroid.R;
import com.example.gfastandroid.modelo.Guitarra;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.example.gfastandroid.modelo.User;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class PerfilFragment extends Fragment {

    public EditText etUserName, etEmail, etName, etSurname, etCity, etPhone, etContribuinte;
    public User user;
    private Guitarra guitarra;
    private FragmentManager fragmentManager;
    private Button editarPerfilbtn;


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {


        View view = inflater.inflate(R.layout.fragment_perfil, container, false);


        SharedPreferences sharedPreferencesUser = getActivity().getSharedPreferences(MenuMainActivity.LOGIN, Context.MODE_PRIVATE);
        String username = sharedPreferencesUser.getString(MenuMainActivity.USERNAME, null);
        String token = sharedPreferencesUser.getString(MenuMainActivity.TOKEN, null);
        String email = sharedPreferencesUser.getString("email", null);
        String us_nome = sharedPreferencesUser.getString("us_nome", null);
        String us_apelido = sharedPreferencesUser.getString("us_apelido", null);
        String us_cidade = sharedPreferencesUser.getString("us_cidade", null);
        int us_contribuinte = sharedPreferencesUser.getInt("us_contribuinte", 0);
        int us_telemovel = sharedPreferencesUser.getInt("us_telemovel", 0);
        int iduser = sharedPreferencesUser.getInt("iduser", 0);


        user = SingletonGestorGfast.getInstance(getContext()).getUser();

        fragmentManager = getFragmentManager();
        etUserName = view.findViewById(R.id.etUserName);
        etUserName.setText(username);

        etEmail = view.findViewById(R.id.etEmail);
        etEmail.setText(email);

        etName = view.findViewById(R.id.etName);
        etName.setText(us_nome);


        etSurname = view.findViewById(R.id.etSurname);
        etSurname.setText(us_apelido);


        etCity = view.findViewById(R.id.etCity);
        etCity.setText(us_cidade);


        etContribuinte = view.findViewById(R.id.etContribuinte);
        etContribuinte.setText(String.valueOf(us_contribuinte));


        etPhone = view.findViewById(R.id.etPhone);
        etPhone.setText(String.valueOf(us_telemovel));




        editarPerfilbtn = view.findViewById(R.id.btnEditarPerfil);

        editarPerfilbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                //SingletonGestorGfast.getInstance(getContext()).setUserListener(this);

                if (user != null && iduser != 0) {

                    user.setUsername(etUserName.getText().toString());
                    user.setUs_nome(etName.getText().toString());
                    user.setUs_apelido(etSurname.getText().toString());
                    user.setUs_cidade(etCity.getText().toString());
                    user.setEmail(etEmail.getText().toString());
                    user.setUs_telemovel(Integer.parseInt(etPhone.getText().toString()));
                    user.setUs_contribuinte(Integer.parseInt(etContribuinte.getText().toString()));

                    SingletonGestorGfast.getInstance(getContext()).editarUser(user, iduser, getContext());

                }


            }
        });
        return view;
    }
}