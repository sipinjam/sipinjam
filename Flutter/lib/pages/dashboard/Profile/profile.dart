import 'package:d_button/d_button.dart';
import 'package:d_info/d_info.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/authentication/loginPage.dart';
import 'package:sipit_app/pages/dashboard/Profile/editProfile.dart';
import 'package:sipit_app/pages/dashboard/Profile/faq.dart';
import 'package:sipit_app/pages/dashboard/Profile/updatePassword.dart';

class ProfilePage extends StatelessWidget {
  const ProfilePage({super.key});

  logout(BuildContext context) {
    DInfo.dialogConfirmation(
            context, textNo: 'Cancel', 'Logout', 'You sure want to logout?')
        .then((yes) {
      if (yes ?? false) {
        Nav.replace(context, const LoginPage());
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[200],
      body: Column(
        children: [
          // Bagian atas (Info profil)
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 20),
            child: Container(
              padding: EdgeInsets.all(16.0),
              decoration: BoxDecoration(
                color: Colors.blue[700],
                borderRadius: BorderRadius.all(Radius.circular(20)),
              ),
              child: Row(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  CircleAvatar(
                    radius: 40.0,
                    backgroundColor: Colors.white,
                    child: Icon(
                      Icons.person,
                      size: 40.0,
                      color: Colors.blue[700],
                    ),
                  ),
                  SizedBox(width: 16.0),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'PENGGUNA SIPIT',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 20.0,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        'sipitmataku@gmail.com',
                        style: TextStyle(
                          color: Colors.white70,
                          fontSize: 16.0,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
          Card(
            color: Colors.white, // Warna abu-abu
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10), // Sudut membulat
            ),
            elevation: 4, // Efek bayangan
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  ListTile(
                    leading: Icon(Icons.edit),
                    title: Text('EDIT PROFILE'),
                    trailing: Icon(Icons.arrow_forward_ios),
                    onTap: () {
                      Nav.push(context, EditProfileApp());
                    },
                  ),
                  Divider(),
                  ListTile(
                    leading: Icon(Icons.lock),
                    title: Text('EDIT PASSWORD'),
                    trailing: Icon(Icons.arrow_forward_ios),
                    onTap: () {
                      Nav.push(context, UpdatePass());
                    },
                  ),
                  Divider(),
                  ListTile(
                    leading: Icon(Icons.notifications),
                    title: Text('NOTIFIKASI'),
                    trailing: Switch(
                      value:
                          true, // ganti dengan state logika apakah notifikasi aktif atau tidak
                      onChanged: (bool value) {
                        // Aksi ketika Switch ditekan
                      },
                    ),
                  ),
                  Divider(),
                  ListTile(
                    leading: Icon(Icons.language),
                    title: Text('BAHASA'),
                    trailing: Icon(Icons.arrow_forward_ios),
                    onTap: () {
                      // Aksi ketika tombol Bahasa ditekan
                    },
                  ),
                  Divider(),
                  ListTile(
                    leading: Icon(Icons.help_outline),
                    title: Text('FAQ'),
                    trailing: Icon(Icons.arrow_forward_ios),
                    onTap: () {
                      Nav.push(context, FaqPage());
                    },
                  ),
                  SizedBox(height: 20.0),
                  // Tombol Logout
                  Center(
                    child: TextButton(
                      onPressed: () {
                        Nav.replace(context, const LoginPage());
                      },
                      child: DButtonBorder(
                          onClick: () => logout(context),
                          radius: 10,
                          borderColor: const Color.fromARGB(255, 211, 211, 211),
                          child: const Text(
                            "LOG OUT",
                            style: TextStyle(color: Colors.red),
                          )),
                    ),
                  ),
                ],
              ),
            ),
          ),
          // Daftar pengaturan
        ],
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    home: ProfilePage(),
  ));
}
