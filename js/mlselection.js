/* 多级选择相关函数，如地区选择，分类选择
 * multi-level selection
 */
/* 地区选择函数 */
function regionInit(divId)
{
    jQuery("#" + divId + " > select").change(regionChange); // select的onchange事件
    jQuery("#" + divId + " > input:button[class='edit_region']").click(regionEdit); // 编辑按钮的onclick事件
}

function regionChange()
{
    // 删除后面的select
    jQuery(this).nextAll("select").remove();

    // 计算当前选中到id和拼起来的name
    var selects = jQuery(this).siblings("select").andSelf();
    var id = 0;
    var names = new Array();
    for (i = 0; i < selects.length; i++)
    {
        sel = selects[i];
        if (sel.value > 0)
        {
            id = sel.value;
            name = sel.options[sel.selectedIndex].text;
            names.push(name);
        }
    }
    jQuery(".mls_id").val(id);
    jQuery(".mls_name").val(name);
    jQuery(".mls_names").val(names.join("\t"));

    // ajax请求下级地区
    if (this.value > 0)
    {
        var _self = this;
        var url = '/mlselection/index/type/region';
        jQuery.getJSON(url, {'pid':this.value}, function(data){
            if (data.flag=='s')
            {
                if (data.datas.length > 0)
                {
                    jQuery("<select><option>请选择区域</option></select>").change(regionChange).insertAfter(_self);
                    var data  = data.datas;
                    for (i = 0; i < data.length; i++)
                    {
                        jQuery(_self).next("select").append("<option value='" + data[i].region_id + "'>" + data[i].region_name + "</option>");
                    }
                }
            }
            else
            {
                alert(data.msg);
            }
        });
    }
}

function regionEdit()
{
    jQuery(this).siblings("select").show();
    jQuery(this).siblings("span").andSelf().hide();
}
