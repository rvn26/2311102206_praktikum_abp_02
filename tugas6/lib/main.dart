import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Widgets Demo',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
        useMaterial3: true,
      ),
      home: const WidgetsShowcasePage(),
    );
  }
}

class WidgetsShowcasePage extends StatefulWidget {
  const WidgetsShowcasePage({super.key});

  @override
  State<WidgetsShowcasePage> createState() => _WidgetsShowcasePageState();
}

class _WidgetsShowcasePageState extends State<WidgetsShowcasePage> {
  // Data untuk ListView.builder
  final List<String> dataList = [
    'Ujang Kdu 1',
    'Ujang Kdu 2',
    'Ujang Kdu 3',
    'Ujang Kdu 4',
    'Ujang Kdu 5',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Flutter Widgets Demo'),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // 1. CONTAINER - Kotak Berwarna
              _buildSectionTitle('1.Container - Kotak Berwarna'),
              Container(
                width: double.infinity,
                height: 100,
                decoration: BoxDecoration(
                  color: Colors.blue,
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: Colors.blueAccent, width: 3),
                ),
                child: const Center(
                  child: Text(
                    'Container Box',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
              const SizedBox(height: 24),

              // 2. GRIDVIEW - Grid dengan minimal 6 item
              _buildSectionTitle('2. GridView - 6 Item Grid'),
              GridView.count(
                crossAxisCount: 3,
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                mainAxisSpacing: 10,
                crossAxisSpacing: 10,
                children: List.generate(
                  6,
                  (index) => Container(
                    decoration: BoxDecoration(
                      color: Colors.primaries[index % Colors.primaries.length],
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Center(
                      child: Text(
                        'Item ${index + 1}',
                        style: const TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          fontSize: 14,
                        ),
                      ),
                    ),
                  ),
                ),
              ),
              const SizedBox(height: 24),

              // 3. LISTVIEW - 3 Item (A, B, C)
              _buildSectionTitle('3. ListView - 3 Item (A, B, C)'),
              Container(
                height: 120,
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.grey),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  children: const [
                    ListViewItem(label: 'A', color: Colors.green),
                    ListViewItem(label: 'B', color: Colors.orange),
                    ListViewItem(label: 'C', color: Colors.purple),
                  ],
                ),
              ),
              const SizedBox(height: 24),

              // 4. LISTVIEW.BUILDER - List dari Data Array
              _buildSectionTitle('4. ListView.builder - List dari Array'),
              Container(
                height: 150,
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.grey),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: ListView.builder(
                  itemCount: dataList.length,
                  itemBuilder: (context, index) {
                    return ListTile(
                      leading: CircleAvatar(
                        backgroundColor: Colors.blue,
                        child: Text('${index + 1}'),
                      ),
                      title: Text(dataList[index]),
                      subtitle: Text('Subtitle untuk ${dataList[index]}'),
                      trailing: const Icon(Icons.arrow_forward),
                    );
                  },
                ),
              ),
              const SizedBox(height: 24),

              // 5. LISTVIEW.SEPARATED - List + Garis Pembatas
              _buildSectionTitle(
                '5. ListView.separated - List dengan Separator',
              ),
              Container(
                height: 150,
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.grey),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: ListView.separated(
                  itemCount: 5,
                  separatorBuilder: (context, index) {
                    return const Divider(thickness: 2, color: Colors.grey);
                  },
                  itemBuilder: (context, index) {
                    return Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16.0),
                      child: ListTile(
                        title: Text(
                          'Item Separated ${index + 1}',
                          style: const TextStyle(fontWeight: FontWeight.bold),
                        ),
                        trailing: Chip(
                          label: Text('#${index + 1}'),
                          backgroundColor: Colors.lightBlue,
                        ),
                      ),
                    );
                  },
                ),
              ),
              const SizedBox(height: 24),

              // 6. STACK - Tampilan Bertumpuk
              _buildSectionTitle('6. Stack - Tampilan Bertumpuk'),
              SizedBox(
                height: 200,
                child: Stack(
                  children: [
                    // Background box
                    Container(
                      decoration: BoxDecoration(
                        color: Colors.red,
                        borderRadius: BorderRadius.circular(10),
                      ),
                    ),
                    // Middle box
                    Positioned(
                      top: 20,
                      left: 20,
                      right: 20,
                      bottom: 20,
                      child: Container(
                        decoration: BoxDecoration(
                          color: Colors.orange,
                          borderRadius: BorderRadius.circular(8),
                        ),
                      ),
                    ),
                    // Top box
                    Positioned(
                      top: 40,
                      left: 40,
                      right: 40,
                      bottom: 40,
                      child: Container(
                        decoration: BoxDecoration(
                          color: Colors.yellow,
                          borderRadius: BorderRadius.circular(8),
                          border: Border.all(color: Colors.black, width: 2),
                        ),
                        child: const Center(
                          child: Text(
                            'Stack Bertumpuk',
                            style: TextStyle(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: Colors.black,
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 16,
          fontWeight: FontWeight.bold,
          color: Colors.blueAccent,
        ),
      ),
    );
  }
}

// Widget helper untuk ListView
class ListViewItem extends StatelessWidget {
  final String label;
  final Color color;

  const ListViewItem({super.key, required this.label, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      width: 100,
      margin: const EdgeInsets.all(8),
      decoration: BoxDecoration(
        color: color,
        borderRadius: BorderRadius.circular(8),
      ),
      child: Center(
        child: Text(
          label,
          style: const TextStyle(
            color: Colors.white,
            fontSize: 24,
            fontWeight: FontWeight.bold,
          ),
        ),
      ),
    );
  }
}
