import 'package:flutter/material.dart';
import 'package:sipit_app/pages/dashboard/History/history.dart';
import 'package:sipit_app/pages/dashboard/Home/homePage.dart';
import 'package:sipit_app/pages/dashboard/PeminjamanForm/peminjaman.dart';
import 'package:sipit_app/pages/dashboard/Profile/profile.dart';
import 'package:sipit_app/pages/dashboard/Schedule/schedule.dart';

class AppConstants {
  static const _host = "http://192.168.1.7:8000";

  static const apiUrl = "$_host/api";
  static const baseUrl = "$apiUrl/routes";

  static List<Map> navMenu = [
    {
      'view': const HomePage(),
      'icon': Icons.home_filled,
      'label': 'Home',
    },
    {
      'view': const PeminjamanPage(),
      'icon': Icons.article_rounded,
      'label': 'Peminjaman',
    },
    {
      'view': const HistoryPage(),
      'icon': Icons.history_rounded,
      'label': 'History',
    },
    {
      'view': const SchedulePage(),
      'icon': Icons.calendar_month_outlined,
      'label': 'Schedule',
    },
    {
      'view': const ProfilePage(),
      'icon': Icons.account_circle,
      'label': 'Profile',
    },
  ];
}
