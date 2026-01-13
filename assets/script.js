jQuery(document).ready(function($){
  // 页面加载时的调试信息
  console.log('=== Guide Navigation 插件加载 ===');
  console.log('jQuery版本:', $.fn.jquery);
  console.log('页面URL:', window.location.href);
  console.log('Elementor编辑模式:', window.location.href.includes('elementor'));
  
  // 多次检查页面元素（Elementor环境中元素可能延迟加载）
  function checkElements() {
    console.log('=== 页面元素检查 ===');
    console.log('guide-process-csv按钮数量:', $('#guide-process-csv').length);
    console.log('guide-csv-file输入框数量:', $('#guide-csv-file').length);
    console.log('guide-csv-upload-area区域数量:', $('#guide-csv-upload-area').length);
    
    // 检查Elementor环境
    console.log('Elementor对象存在:', typeof elementor !== 'undefined');
    console.log('Elementor面板存在:', typeof elementor !== 'undefined' && elementor.panel);
    console.log('页面中iframe数量:', $('iframe').length);
    
    if ($('#guide-process-csv').length === 0) {
      console.warn('⚠️ 未找到CSV处理按钮，可能原因：');
      console.warn('1. 不在Elementor编辑界面');
      console.warn('2. 未选择Guide Navigation组件');
      console.warn('3. 页面未完全加载');
      
      // 列出所有包含"解析"或"csv"的按钮
      var allButtons = $('button, input[type="button"]');
      console.log('页面中所有按钮:', allButtons.length);
      allButtons.each(function(index, btn) {
        var text = $(btn).text().toLowerCase();
        if (text.includes('解析') || text.includes('csv') || text.includes('guide')) {
          console.log('- 相关按钮:', btn.id, btn.className, $(btn).text());
        }
      });
      
      // 检查是否在iframe中
      if (window.parent !== window) {
        console.log('当前在iframe中，尝试检查父窗口');
        try {
          var parentButtons = $(window.parent.document).find('#guide-process-csv');
          console.log('父窗口中的CSV按钮数量:', parentButtons.length);
        } catch (e) {
          console.log('无法访问父窗口:', e.message);
        }
      }
    } else {
      console.log('✅ 找到CSV处理按钮');
    }
  }
  
  // 立即检查一次
  checkElements();
  
  // 延迟检查多次（适应Elementor的动态加载）
  setTimeout(checkElements, 1000);
  setTimeout(checkElements, 3000);
  setTimeout(checkElements, 5000);
  
  // 将检查函数暴露到全局，方便调试
  window.guideDebugCheck = checkElements;
  window.guideForceCSVTest = function() {
    console.log('=== 强制CSV测试 ===');
    var testData = 'Google,https://google.com,"搜索引擎，全球最大的搜索平台"\nGitHub,https://github.com,"代码托管平台，开发者的首选"\n"Stack Overflow","https://stackoverflow.com",程序员问答社区\n"WordPress官网","https://wordpress.org","内容管理系统，支持多种功能"';
    console.log('测试数据（包含引号测试）:', testData);
    try {
      var result = parseCSV(testData);
      console.log('解析结果:', result);
      processCSVData(result);
    } catch (e) {
      console.error('测试失败:', e);
    }
  };
  
  console.log('💡 调试提示：');
  console.log('- 在控制台输入 guideDebugCheck() 可手动检查元素');
  console.log('- 在控制台输入 guideForceCSVTest() 可强制测试CSV功能');
  
  // 提取域名的函数
  function extractDomainName(url) {
    try {
      const urlObj = new URL(url.startsWith('http') ? url : 'https://' + url);
      return urlObj.hostname.replace('www.', '');
    } catch (e) {
      return url;
    }
  }
  
  // Elementor自动填充功能
  $(document).on('input', '.elementor-control-url input', function() {
    const url = $(this).val();
    if (url) {
      const domainName = extractDomainName(url);
      const nameInput = $(this).closest('.elementor-repeater-row-controls').find('.elementor-control-name input');
      if (nameInput.length && !nameInput.val()) {
        nameInput.val(domainName);
        nameInput.trigger('input');
      }
    }
  });
  
  // 使用MutationObserver监听DOM变化，确保动态添加的元素也能被处理
  var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.type === 'childList') {
        mutation.addedNodes.forEach(function(node) {
          if (node.nodeType === 1) { // Element node
            var $node = $(node);
            if ($node.find('#guide-process-csv').length > 0 || $node.attr('id') === 'guide-process-csv') {
              console.log('✅ 检测到CSV按钮被动态添加');
              checkElements();
            }
          }
        });
      }
    });
  });
  
  // 开始观察DOM变化
  observer.observe(document.body, {
    childList: true,
    subtree: true
  });
  
  // CSV文件上传和解析功能
  $(document).on('click', '#guide-process-csv', function(){
    console.log('=== CSV按钮点击事件触发 ===');
    console.log('按钮元素:', this);
    console.log('jQuery版本:', $.fn.jquery);
    console.log('相关元素数量:', $('#guide-csv-file').length);
    console.log('文件输入框元素:', $('#guide-csv-file')[0]);
    
    const fileInput = $('#guide-csv-file')[0];
    if (!fileInput) {
      console.error('❌ 找不到文件输入框');
      alert('找不到文件输入框，请刷新页面重试');
      return;
    }
    
    if (!fileInput.files || fileInput.files.length === 0) {
      console.warn('⚠️ 未选择文件');
      alert('请先选择一个CSV文件');
      return;
    }
    
    const file = fileInput.files[0];
    console.log('选择的文件:', file.name, '大小:', file.size, 'bytes');
    
    // 显示处理中状态
    const button = $(this);
    const originalText = button.text();
    button.text('处理中...').prop('disabled', true);
    
    const reader = new FileReader();
    reader.onload = function(e) {
      console.log('文件读取完成');
      const csvContent = e.target.result;
      console.log('CSV内容长度:', csvContent.length, '字符');
      
      try {
        const parsedData = parseCSV(csvContent);
        console.log('CSV解析成功，解析出', parsedData.length, '条记录');
        processCSVData(parsedData);
      } catch (error) {
        console.error('CSV解析错误:', error);
        alert('CSV解析失败: ' + error.message);
      } finally {
        // 恢复按钮状态
        button.text(originalText).prop('disabled', false);
      }
    };
    
    reader.onerror = function() {
      console.error('文件读取失败');
      alert('文件读取失败，请重试');
      button.text(originalText).prop('disabled', false);
    };
    
    reader.readAsText(file, 'UTF-8');
  });
  
  // 强化CSV解析函数（支持RFC 4180标准）
  function parseCSV(text) {
    console.log('开始解析CSV内容');
    const lines = text.split('\n');
    const result = [];
    
    // 解析单行CSV的函数
    function parseCSVLine(line) {
      const fields = [];
      let current = '';
      let inQuotes = false;
      let quoteChar = '';
      
      for (let i = 0; i < line.length; i++) {
        const char = line[i];
        
        if (!inQuotes) {
          if (char === '"' || char === "'") {
            inQuotes = true;
            quoteChar = char;
          } else if (char === ',') {
            fields.push(current.trim());
            current = '';
          } else {
            current += char;
          }
        } else {
          if (char === quoteChar) {
            // 检查是否是转义引号
            if (i + 1 < line.length && line[i + 1] === quoteChar) {
              current += char;
              i++; // 跳过下一个引号
            } else {
              inQuotes = false;
              quoteChar = '';
            }
          } else {
            current += char;
          }
        }
      }
      
      // 添加最后一个字段
      fields.push(current.trim());
      return fields;
    }
    
    for (let i = 0; i < lines.length; i++) {
      const line = lines[i].trim();
      if (line) {
        const fields = parseCSVLine(line);
        if (fields.length >= 2) {
          const name = fields[0] || '';
          const url = fields[1] || '';
          const description = fields[2] || '';
          
          console.log('解析行:', i, '名称:', name, 'URL:', url, '描述:', description);
          
          if (name && url) {
            result.push({
              name: name,
              url: url,
              description: description
            });
          }
        }
      }
    }
    
    console.log('CSV解析完成，有效记录数:', result.length);
    return result;
  }
  
  // 处理CSV数据
  function processCSVData(data) {
    console.log('开始处理CSV数据，共', data.length, '条记录');
    
    if (data.length === 0) {
      alert('CSV文件中没有找到有效数据');
      return;
    }
    
    // 尝试使用Elementor API添加项目
    if (typeof elementor !== 'undefined' && elementor.panel) {
      console.log('使用Elementor API添加项目');
      try {
        const model = elementor.panel.currentView.getOption('model');
        const items = model.get('settings').get('items');
        
        data.forEach(item => {
          items.add({
            url: item.url,
            name: item.name,
            desc: item.description,  // 注意：Elementor中字段名是'desc'
            _id: elementor.helpers.getUniqueId()
          });
          console.log('✅ 通过API添加项目:', item.name, '描述:', item.description);
        });
        
        console.log('✅ 成功通过Elementor API添加', data.length, '个项目');
        alert('成功导入 ' + data.length + ' 个导航项目！');
      } catch (error) {
        console.error('Elementor API添加失败:', error);
        fallbackAddItems(data);
      }
    } else {
      console.log('Elementor API不可用，使用备用方案');
      fallbackAddItems(data);
    }
  }
  
  // 备用添加方案
  function fallbackAddItems(data) {
    console.log('使用DOM操作备用方案');
    
    // 查找添加按钮
    const addButton = $('.elementor-repeater-add');
    if (addButton.length === 0) {
      console.error('❌ 找不到添加按钮');
      alert('找不到添加按钮，请确保在Elementor编辑界面中选择了Guide Navigation组件');
      return;
    }
    
    console.log('找到添加按钮，开始逐个添加项目');
    
    let addedCount = 0;
    
    function addNextItem() {
      if (addedCount >= data.length) {
        console.log('✅ 所有项目添加完成');
        alert('成功导入 ' + data.length + ' 个导航项目！');
        return;
      }
      
      const item = data[addedCount];
      console.log('添加项目', addedCount + 1, ':', item.name);
      
      // 点击添加按钮
      addButton.click();
      
      // 等待新行出现后填充数据
      setTimeout(() => {
        const rows = $('.elementor-repeater-row-controls');
        const lastRow = rows.last();
        
        // 填充URL
        const urlInput = lastRow.find('.elementor-control-url input');
        if (urlInput.length) {
          urlInput.val(item.url).trigger('input');
        }
        
        // 填充名称
        const nameInput = lastRow.find('.elementor-control-name input');
        if (nameInput.length) {
          nameInput.val(item.name).trigger('input');
        }
        
        // 填充描述（注意：Elementor中字段名是'desc'不是'description'）
        const descInput = lastRow.find('.elementor-control-desc textarea, .elementor-control-desc input');
        if (descInput.length && item.description) {
          descInput.val(item.description).trigger('input');
          console.log('✅ 成功填充描述:', item.description);
        } else {
          console.log('⚠️ 未找到描述输入框或描述为空');
          console.log('- 描述输入框数量:', descInput.length);
          console.log('- 描述内容:', item.description);
        }
        
        addedCount++;
        
        // 继续添加下一个项目
        setTimeout(addNextItem, 500);
      }, 300);
    }
    
    addNextItem();
  }
  
  // Corner Icon点击事件处理
  $(document).on('click', '.guide-nav-corner-icon', function(e) {
    console.log('Corner icon clicked (jQuery)');
    e.preventDefault();
    
    var cornerUrl = $(this).attr('data-corner-url');
    console.log('Corner URL:', cornerUrl);
    
    if (cornerUrl && cornerUrl.trim() !== '') {
      console.log('Opening URL:', cornerUrl);
      window.open(cornerUrl, '_blank');
    }
  });
});

// 原生JavaScript备用方案（如果jQuery不可用）
if (typeof jQuery === 'undefined') {
  document.addEventListener('DOMContentLoaded', function() {
    console.log('jQuery not available, using vanilla JS');
    
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('guide-nav-corner-icon')) {
        console.log('Corner icon clicked (vanilla JS)');
        e.preventDefault();
        
        var cornerUrl = e.target.getAttribute('data-corner-url');
        console.log('Corner URL:', cornerUrl);
        
        if (cornerUrl && cornerUrl.trim() !== '') {
          console.log('Opening URL:', cornerUrl);
          window.open(cornerUrl, '_blank');
        }
      }
    });
  });
}