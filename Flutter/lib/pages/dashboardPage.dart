import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/providers/dashboard_provider.dart';

class Dashboardpage extends StatelessWidget {
  const Dashboardpage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Consumer(builder: (_, wiRef, __) {
        int navIndex = wiRef.watch(dashboardNavIndexProvider);
        return AppConstants.navMenu[navIndex]['view'] as Widget;
      }),
      bottomNavigationBar: Consumer(builder: (_, wiRef, __) {
        int navIndex = wiRef.watch(dashboardNavIndexProvider);
        return BottomNavigationBar(
          items: AppConstants.navMenu.map((e) {
            return BottomNavigationBarItem(
                icon: Icon(e['icon']), label: e['label']);
          }).toList(),
          selectedItemColor: const Color(0xff2F2F2F),
          unselectedItemColor: Colors.grey[400],
          showUnselectedLabels: false,
          showSelectedLabels: false,
          iconSize: 28,
          currentIndex: navIndex,
          type: BottomNavigationBarType.fixed,
          onTap: (value) {
            wiRef.read(dashboardNavIndexProvider.notifier).state = value;
          },
        );
      }),
    );
  }
}
