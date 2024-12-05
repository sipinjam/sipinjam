import 'package:d_button/d_button.dart';
import 'package:d_info/d_info.dart';
import 'package:d_view/d_view.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/models/peminjamModel.dart';
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
        AppSession.removePeminjam();
        SharedPreferences.getInstance().then((prefs) {
          prefs.setBool('is_logged_in', false);
        });
        Nav.replace(context, const LoginPage());
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<PeminjamModel?>(
        future: AppSession.getPeminjam(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return DView.loadingCircle();
          }

          if (!snapshot.hasData || snapshot.data == null) {
            return const Center(child: Text("No profile data available."));
          }

          PeminjamModel peminjam = snapshot.data!;

          print("Nama Peminjam: ${peminjam.namaPeminjam}");
          print("Email: ${peminjam.email}");

          return Scaffold(
            backgroundColor: Colors.grey[200],
            body: Column(
              children: [
                // Bagian atas (Info profil)
                Padding(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 20),
                  child: Container(
                    padding: const EdgeInsets.all(16.0),
                    decoration: BoxDecoration(
                      color: Colors.blue[700],
                      borderRadius: const BorderRadius.all(Radius.circular(20)),
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
                        const SizedBox(width: 16.0),
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              peminjam.namaPeminjam,
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 20.0,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            Text(
                              peminjam.email,
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
                          leading: const Icon(Icons.edit),
                          title: const Text('EDIT PROFILE'),
                          trailing: const Icon(Icons.arrow_forward_ios),
                          onTap: () {
                            Nav.push(context, EditProfileApp());
                          },
                        ),
                        const Divider(),
                        ListTile(
                          leading: const Icon(Icons.lock),
                          title: const Text('EDIT PASSWORD'),
                          trailing: const Icon(Icons.arrow_forward_ios),
                          onTap: () {
                            Nav.push(context, UpdatePass());
                          },
                        ),
                        const Divider(),
                        ListTile(
                          leading: const Icon(Icons.help_outline),
                          title: const Text('FAQ'),
                          trailing: const Icon(Icons.arrow_forward_ios),
                          onTap: () {
                            Nav.push(context, FaqPage());
                          },
                        ),
                        const SizedBox(height: 20.0),
                        // Tombol Logout
                        Center(
                          child: TextButton(
                            onPressed: () {
                              Nav.replace(context, const LoginPage());
                            },
                            child: DButtonBorder(
                                onClick: () => logout(context),
                                radius: 10,
                                borderColor:
                                    const Color.fromARGB(255, 211, 211, 211),
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
              ],
            ),
          );
        });
  }
}

void main() {
  runApp(const MaterialApp(
    home: ProfilePage(),
  ));
}
